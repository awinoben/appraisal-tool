<?php

namespace App\Jobs;

use App\Http\Controllers\SystemController;
use App\Models\CSVData;
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
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class TeamUserAssignJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param string $id
     */
    public function __construct(
        private string $id
    )
    {
    }

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public int $timeout = 600;

    /**
     * set a middleware to prevent job overlapping
     *
     * @return array
     */
    public function middleware(): array
    {
        return [
            (new WithoutOverlapping($this->id))->dontRelease(),
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
        // assign all the team users
        $count = 0;

        // @todo fetch the contacts here that were save temporarily from file
        $data = CSVData::query()
            ->latest()
            ->where('processed', false)
            ->where('id', $this->id)
            ->first();

        foreach ($data->data as $datum) {
            try {
                $query = new User();

                // check if the team exists
                $team_lead = $query->firstWhere('email', Str::lower(str_replace(' ', '', $datum['SUPERVISOR EMAIL'])));

                $team = Team::query()->updateOrCreate([
                    'user_id' => $team_lead->user_id
                ], [
                    'name' => $team_lead->name . ' Team'
                ]);

                // first fetch the user
                $user = $query->firstWhere('email', Str::lower(str_replace(' ', '', $datum['EMAIL'])));

                if ($user) {
                    // assign user to the team
                    TeamUser::query()->updateOrCreate([
                        'team_id' => $team->id,
                        'user_id' => $user->id
                    ]);

                    // do the count
                    $count++;
                }

            } catch (Exception $exception) {
                SystemController::log([
                    'exception' => $exception->getMessage(),
                    'file' => $data->file,
                    'assigned users' => number_format($count)
                ], 'error', 'team-members-error');
                continue;
            }
        }


        // update the processed csv data to processed
        $data->update([
            'processed' => true
        ]);

        SystemController::log([
            'file' => $data->file,
            'assigned users' => number_format($count)
        ], 'success', 'team-members');

    }
}
