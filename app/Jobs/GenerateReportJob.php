<?php

namespace App\Jobs;

use App\Exports\ReportExport;
use App\Http\Controllers\SystemController;
use App\Models\Result;
use App\Models\Role;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;

class  GenerateReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param string $sap_number
     * @param string $user_id
     * @param string $project_id
     * @param string $userName
     */
    public function __construct(
        private string $sap_number,
        private string $user_id,
        private string $project_id,
        private string $userName
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
        // set the file name here
        $fileName = Str::slug($this->sap_number . '_' . $this->userName) . '.xlsx';

        // start the checks
        $exists = File::exists(storage_path('app/public/' . $fileName));
        if ($exists) {
            // unlink the media here after upload
            unlink(storage_path('app/public/' . $fileName));

            // log here
            SystemController::log([
                'FileName' => $fileName,
                'Message' => 'Removed existing file.',
            ], 'success', 'report-generation');
        } else {
            // log here
            SystemController::log([
                'FileName' => $fileName,
                'Message' => 'No file was removed.',
            ], 'success', 'report-generation');
        }

        // generate report and store
//        Excel::store(new ReportExport(
//            $this->user_id,
//            $this->project_id
//        ), $fileName, 'public', ExcelFormat::XLSX);

        // update the result table
        Result::query()
            ->where('user_id', $this->user_id)
            ->where('project_id', $this->project_id)
            ->update([
                'report_url' => config('app.url') . '/storage/' . $fileName // set the path for down loading
            ]);

        foreach (Role::all() as $role) {
            dispatch(new GeneralReportJob($role->slug, $role->id))->onQueue('default')->delay(5);
        }

        // generate the general report
        dispatch(new GeneralReportJob('general_report', '7b99492c-9bfc-4e7d-a86f-c2bf861c8be1', true))->onQueue('default')->delay(10);
    }
}
