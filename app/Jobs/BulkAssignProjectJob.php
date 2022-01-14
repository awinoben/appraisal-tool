<?php

namespace App\Jobs;

use App\Http\Controllers\SystemController;
use App\Models\CSVData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BulkAssignProjectJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param string $id
     * @param string $file_name
     */
    public function __construct(
        private string $id,
        private string $file_name
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // set counter
        $count = 0;

        // @todo fetch the contacts here that were save temporarily from file
        $data = CSVData::query()
            ->latest()
            ->where('processed', false)
            ->where('id', $this->id)
            ->first();

        foreach (collect($data->data)->chunk(100) as $datas) {
            dispatch(new SyncAssignDepartmentJob(
                $datas
            ))->onQueue('uploads')->delay(2);

            $count += count($datas);
        }


        // update the processed csv data to processed
        $data->update([
            'processed' => true
        ]);

        SystemController::log([
            'file' => $data->file,
            'assigned users' => number_format($count)
        ], 'success', 'assigned-users');
    }
}
