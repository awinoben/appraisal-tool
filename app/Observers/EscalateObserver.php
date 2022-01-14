<?php

namespace App\Observers;

use App\Models\Escalate;

class EscalateObserver
{
    /**
     * Handle the Escalate "created" event.
     *
     * @param Escalate $escalate
     * @return void
     */
    public function created(Escalate $escalate)
    {
        $escalate->result()->update([
            'is_rejected' => true
        ]);
    }

    /**
     * Handle the Escalate "updated" event.
     *
     * @param Escalate $escalate
     * @return void
     */
    public function updated(Escalate $escalate)
    {
        $escalate->result()->update([
            'is_accepted' => $escalate->is_closed,
            'is_rejected' => false
        ]);

        // update all the escalations of this particular user
        Escalate::query()
            ->where('is_closed', false)
            ->where('result_id', $escalate->result_id)
            ->update([
                'is_closed' => $escalate->is_closed
            ]);
    }

    /**
     * Handle the Escalate "deleted" event.
     *
     * @param Escalate $escalate
     * @return void
     */
    public function deleted(Escalate $escalate)
    {
        //
    }

    /**
     * Handle the Escalate "restored" event.
     *
     * @param Escalate $escalate
     * @return void
     */
    public function restored(Escalate $escalate)
    {
        //
    }

    /**
     * Handle the Escalate "force deleted" event.
     *
     * @param Escalate $escalate
     * @return void
     */
    public function forceDeleted(Escalate $escalate)
    {
        //
    }
}
