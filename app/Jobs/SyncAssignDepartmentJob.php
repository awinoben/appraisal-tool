<?php

namespace App\Jobs;

use App\Http\Controllers\SystemController;
use App\Models\AssignedProject;
use App\Models\Project;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptions;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class SyncAssignDepartmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private $datas
    )
    {
    }

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public int $timeout = 300;

    /**
     * set a middleware to prevent job overlapping
     *
     * @return array
     */
    public function middleware(): array
    {
        return [
            (new ThrottlesExceptions(5, 5))->backoff(5)
        ];
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return DateTime
     */
    public function retryUntil(): DateTime
    {
        return now()->addMinutes(5);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $count = 0;

        foreach ($this->datas as $datum) {
            try {
                // first fetch the user
                $user = User::query()->with(['role'])->where('employee_number', $datum['EMPLOYEE NUMBER'])->first();

                if ($user) {
                    // Fetch the project
                    $project = Project::query()->with(['user'])->firstWhere('slug', Str::slug($datum['DEPARTMENT']));

                    if ($project) {
                        // fetch the supervisor
                        $supervisors = User::query()->with(['role'])->whereIn('email', $project->supervisor_emails)->get();

                        if (count($supervisors)) {
                            // assign user to the project but before that check if user is already assigned to the project.
                            AssignedProject::query()->updateOrCreate([
                                'user_id' => $user->id
                            ], [
                                'project_id' => $project->id,
                            ]);

                            foreach ($supervisors as $supervisor) {
                                // create a team
                                $team = Team::query()->updateOrCreate([
                                    'user_id' => $supervisor->id
                                ], [
                                    'name' => $project->name . ' Team'
                                ]);

                                // update the user role
                                $role = $supervisor->role;
                                $role->level = 2;
                                $role->save();

                                if ($user->email != $project->user->email) {
                                    if ($user->email != $supervisor->email) {
                                        // assign user to the team
                                        TeamUser::query()->updateOrCreate([
                                            'team_id' => $team->id,
                                            'user_id' => $user->id
                                        ]);
                                    }
                                }

                                // create a team for hod
                                $hodTeam = Team::query()->updateOrCreate([
                                    'user_id' => $project->user_id
                                ], [
                                    'name' => $project->name . ' Hod Team'
                                ]);

                                // assign supervisor to the hod team
                                TeamUser::query()->updateOrCreate([
                                    'team_id' => $hodTeam->id,
                                    'user_id' => $supervisor->id
                                ]);
                            }

                            // sync kra's and kpi's for the user
                            dispatch(new SetKraAndKpiJob(
                                $project,
                                $user
                            ))->onQueue('default')->delay(2);

                            // do the count
                            $count++;
                        }
                    }
                }

            } catch (Exception $exception) {
                SystemController::log([
                    'exception' => $exception->getMessage(),
                    'assigned users' => number_format($count)
                ], 'error', 'assigned-users-error');
                continue;
            }
        }
    }
}
