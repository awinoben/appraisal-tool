<?php

namespace App\Jobs;

use App\Http\Controllers\SystemController;
use App\Models\CSVData;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class UploadDepartmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private string $id
    )
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // set counter
        $count = 0;

        // create user instance
        $query = new User();

        // @todo fetch the contacts here that were save temporarily from file
        $data = CSVData::query()
            ->latest()
            ->where('processed', false)
            ->where('id', $this->id)
            ->first();

        foreach ($data->data as $datum) {
            try {
                // fetch the user with email
                $user = $query->with(['role'])->firstWhere('email', Str::lower(str_replace(' ', '', $datum['HEAD OF DEPARTMENT EMAIL'])));

                if ($user) {
                    // check or create a new department/project
                    $project = Project::query()->firstWhere('slug', Str::slug($datum['DEPARTMENT']));

                    if ($project) {
                        array_push($project->supervisor_emails, Str::lower(str_replace(' ', '', $datum['SUPERVISOR EMAIL'])));

                        $project->update([
                            'supervisor_emails' => array_unique($project->supervisor_emails)
                        ]);
                    } else {
                        Project::query()->create([
                            'name' => (string)$datum['DEPARTMENT'],
                            'user_id' => $user->id,
                            'supervisor_emails' => array(Str::lower(str_replace(' ', '', $datum['SUPERVISOR EMAIL']))),
                            'country_id' => $user->country_id,
                        ]);

                        // update the user role
                        $role = $user->role;
                        $role->level = 2;
                        $role->save();
                    }

                    $count++;
                }
            } catch (Exception $exception) {
                SystemController::log([
                    'exception' => $exception->getMessage(),
                    'file' => $data->file,
                    'uploaded' => number_format($count)
                ], 'error', 'department-upload-error');
                continue;
            }

        }

        // update the processed csv data to processed
        $data->update([
            'processed' => true
        ]);

        SystemController::log([
            'file' => $data->file,
            'uploaded' => number_format($count)
        ], 'success', 'department-upload-success');
    }
}
