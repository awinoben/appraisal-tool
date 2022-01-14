<?php

namespace App\Jobs;

use App\Models\PersonalDevelopment;
use App\Models\Report;
use App\Models\Result;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptions;
use Illuminate\Queue\SerializesModels;

class SetKraAndKpiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private object $project,
        private object $user,
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
        // create a result table
        $result = Result::query()->updateOrCreate([
            'user_id' => $this->user->id,
            'project_id' => $this->project->id
        ]);

        // create the report here
        foreach ($this->user->role->key_performance_indicator as $kpi) {
            Report::query()->updateOrCreate([
                'user_id' => $this->user->id,
                'result_id' => $result->id,
                'project_id' => $this->project->id,
                'key_result_area_id' => $kpi->key_result_area_id
            ]);
        }

        // create the personal development
        foreach (config('appraisal.personal') as $personal) {
            PersonalDevelopment::query()->updateOrCreate([
                'project_id' => $this->project->id,
                'user_id' => $this->user->id,
                'type' => $personal
            ]);
        }
    }
}
