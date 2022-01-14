<?php

namespace App\Observers;

use App\Models\Project;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param Project $project
     * @return void
     */
    public function created(Project $project)
    {
        //
    }

    /**
     * Handle the project "updated" event.
     *
     * @param Project $project
     * @return void
     */
    public function updated(Project $project)
    {
        // update the assigned project status
        $project->withoutRelations()->assigned_project()->update([
            'is_closed' => $project->is_closed
        ]);
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param Project $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the project "restored" event.
     *
     * @param Project $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param Project $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
