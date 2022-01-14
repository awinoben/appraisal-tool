<?php

namespace App\Jobs;

use App\Http\Controllers\SystemController;
use App\Models\CSVData;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptions;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;

class UploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param string $id
     * @param string $file_name
     * @param string $country_id
     */
    public function __construct(
        private string $id,
        private string $file_name,
        private string $country_id
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
        // set counter
        $count = 0;

        // @todo fetch the contacts here that were save temporarily from file
        $data = CSVData::query()
            ->latest()
            ->where('processed', false)
            ->where('id', $this->id)
            ->first();

        foreach (collect($data->data)->chunk(100) as $datas) {
            dispatch(new SyncUserJob(
                collect($datas)->toArray(),
                $this->country_id
            ))->onQueue('uploads')->delay(1);

            $count += count($datas);
        }

        // update the processed csv data to processed
        $data->update([
            'processed' => true
        ]);

        SystemController::log([
            'file' => $data->file,
            'uploaded' => number_format($count)
        ], 'success', 'upload-success');
    }
}
