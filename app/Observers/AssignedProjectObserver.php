<?php

namespace App\Observers;

use App\Models\AssignedProject;

class AssignedProjectObserver
{
    /**
     * Handle the assigned project "created" event.
     *
     * @param AssignedProject $assignedProject
     * @return void
     */
    public function created(AssignedProject $assignedProject)
    {
        AssignedProject::query()
            ->whereNotIn('id', [$assignedProject->id])
            ->where('created_at', '<', now())
            ->update([
                'is_closed' => true
            ]);
    }

    /**
     * Handle the assigned project "updated" event.
     *
     * @param AssignedProject $assignedProject
     * @return void
     */
    public function updated(AssignedProject $assignedProject)
    {
        //
    }

    /**
     * Handle the assigned project "deleted" event.
     *
     * @param AssignedProject $assignedProject
     * @return void
     */
    public function deleted(AssignedProject $assignedProject)
    {
        //
    }

    /**
     * Handle the assigned project "restored" event.
     *
     * @param AssignedProject $assignedProject
     * @return void
     */
    public function restored(AssignedProject $assignedProject)
    {
        //
    }

    /**
     * Handle the assigned project "force deleted" event.
     *
     * @param AssignedProject $assignedProject
     * @return void
     */
    public function forceDeleted(AssignedProject $assignedProject)
    {
        //
    }
}
