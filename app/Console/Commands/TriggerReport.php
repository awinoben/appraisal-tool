<?php

namespace App\Console\Commands;

use App\Jobs\GenerateReportJob;
use App\Models\Result;
use Illuminate\Console\Command;

class TriggerReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trigger:reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trigger all reports for users here...';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        Result::query()
            ->latest()
            ->with(['user', 'project.user'])
            ->where('is_accepted', true)
            ->chunk(10000, function ($results) {
                foreach ($results as $result) {
                    // start generating user report
                    dispatch(new GenerateReportJob(
                        $result->user->employee_number,
                        $result->user_id,
                        $result->project_id,
                        $result->user->name
                    ))->onQueue('default')->delay(2);
                }
            });

        return 200;
    }
}
