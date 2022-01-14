<?php

namespace App\Jobs;

use App\Http\Controllers\SystemController;
use App\Models\Branch;
use App\Models\CSVData;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class UploadBranchesJob implements ShouldQueue
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

        // @todo fetch the contacts here that were save temporarily from file
        $data = CSVData::query()
            ->latest()
            ->where('processed', false)
            ->where('id', $this->id)
            ->first();

        foreach ($data->data as $datum) {
            try {
                // create new user here
                Branch::query()->updateOrCreate([
                    'slug' => Str::slug($datum['NAME'])
                ], [
                    'name' => (string)$datum['NAME']
                ]);

                $count++;
            } catch (Exception $exception) {
                SystemController::log([
                    'exception' => $exception->getMessage(),
                    'file' => $data->file,
                    'uploaded' => number_format($count)
                ], 'error', 'branch-upload-error');
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
        ], 'success', 'branch-upload-success');
    }
}
