<?php

namespace App\Observers;

use App\Models\Result;

class ResultObserver
{
    /**
     * Handle the Result "created" event.
     *
     * @param Result $result
     * @return void
     */
    public function created(Result $result)
    {
        //
    }

    /**
     * Handle the Result "updated" event.
     *
     * @param Result $result
     * @return void
     */
    public function updated(Result $result)
    {
        // update the report to accepted
        $load = auth('api')->user()->load('report', 'personal_development', 'behavioral', 'leader_ship');

        // report update
        $load->report()->update([
            'is_accepted' => $result->is_accepted,
            'is_rejected' => $result->is_rejected,
        ]);

        // personal_development update
        $load->personal_development()->update([
            'is_accepted' => $result->is_accepted,
            'is_rejected' => $result->is_rejected,
        ]);
    }

    /**
     * Handle the Result "deleted" event.
     *
     * @param Result $result
     * @return void
     */
    public function deleted(Result $result)
    {
        //
    }

    /**
     * Handle the Result "restored" event.
     *
     * @param Result $result
     * @return void
     */
    public function restored(Result $result)
    {
        //
    }

    /**
     * Handle the Result "force deleted" event.
     *
     * @param Result $result
     * @return void
     */
    public function forceDeleted(Result $result)
    {
        //
    }
}
