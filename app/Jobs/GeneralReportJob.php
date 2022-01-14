<?php

namespace App\Jobs;

use App\Exports\GeneralReportExport;
use App\Http\Controllers\SystemController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;

class GeneralReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param string $type
     * @param string $role_id
     * @param bool $is_general
     */
    public function __construct(
        private string $type,
        private string $role_id,
        private bool   $is_general = false
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
//        // set the file name here
//        $fileName = $this->type . '.xlsx';
//
//        // start the checks
//        $exists = File::exists(storage_path('app/public/' . $fileName));
//        if ($exists) {
//            // unlink the media here after upload
//            unlink(storage_path('app/public/' . $fileName));
//
//            // log here
//            SystemController::log([
//                'FileName' => $fileName,
//                'Message' => 'Removed existing file.',
//            ], 'success', $this->type . '-report');
//        } else {
//            // log here
//            SystemController::log([
//                'FileName' => $fileName,
//                'Message' => 'No file was removed.',
//            ], 'success', $this->type . '-report');
//        }
//
//        // generate report and store
//        Excel::store(new GeneralReportExport($this->role_id, $this->is_general), $fileName, 'public', ExcelFormat::XLSX);
    }
}
