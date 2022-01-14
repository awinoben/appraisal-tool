<?php

namespace App\Jobs;

use App\Exports\ReportExport;
use App\Http\Controllers\SystemController;
use App\Models\User;
use Bugsnag\DateTime\Date;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptions;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;

class ReportGeneratingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private string      $id,
        private string      $project_id,
        private Date|string $from_date,
        private Date|string $to_date,
        private string $type_of_report,
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
        // fetch user here
        $user = User::query()
            ->with(['appraisal_report'])
            ->findOrFail($this->id);

        $report = $user->appraisal_report;
        $fileName = $report->path_name;

        // start the checks
        $exists = File::exists(storage_path('app/public/' . $fileName));
        if ($exists) {
            unlink(storage_path('app/public/' . $fileName));

            // log here
            SystemController::log([
                'FileName' => $fileName,
                'User' => $user->email,
                'Message' => 'Removed existing file ' . $fileName,
            ], 'success', 'report-generation');
        } else {
            // log here
            SystemController::log([
                'FileName' => $fileName,
                'User' => $user->email,
                'Message' => 'No file was removed.',
            ], 'success', 'report-generation');
        }

        // set new name of the file
        $fileName = 'appraisal-report-' . date('Y-m-d', strtotime($this->from_date)) . '-to-' . date('Y-m-d', strtotime($this->to_date)) . '-' . Str::slug(Str::lower(Str::random(8))) . '.xlsx';

        // generate report and store
        Excel::store(new ReportExport(
            $this->project_id,
            $this->from_date,
            $this->to_date,
            $this->type_of_report
        ), $fileName, 'public', ExcelFormat::XLSX);

        // update the report here to is ready to true
        $report->update([
            'path_name' => $fileName,
            'path' => config('app.url') . '/storage/' . $fileName,
            'is_ready' => true,
        ]);
    }
}
