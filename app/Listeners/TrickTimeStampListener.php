<?php

namespace App\Listeners;

use App\Events\TrickTimeStampEvent;
use Illuminate\Support\Facades\Schema;

class TrickTimeStampListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param TrickTimeStampEvent $event
     * @return void
     */
    public function handle(TrickTimeStampEvent $event)
    {
        if (Schema::hasColumn($event->model->getTable(), 'created_at')) {
            if (empty($event->model->created_at)) {
                $event->model->created_at = now()->addSeconds(2);
            }
        }
    }
}
