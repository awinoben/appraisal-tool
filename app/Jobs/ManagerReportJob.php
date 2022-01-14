<?php

namespace App\Jobs;

use App\Exports\ManagerReport;
use App\Http\Controllers\SystemController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;

class ManagerReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // set the file name here
        $fileName = 'manager_report.xlsx';

        // start the checks
        $exists = File::exists(storage_path('app/public/' . $fileName));
        if ($exists) {
            // unlink the media here after upload
            unlink(storage_path('app/public/' . $fileName));

            // log here
            SystemController::log([
                'FileName' => $fileName,
                'Message' => 'Removed existing file.',
            ], 'success', 'manager-report');
        } else {
            // log here
            SystemController::log([
                'FileName' => $fileName,
                'Message' => 'No file was removed.',
            ], 'success', 'manager-report');
        }

        // generate report and store
        Excel::store(new ManagerReport(), $fileName, 'public', ExcelFormat::XLSX);
    }
}
