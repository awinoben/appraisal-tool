<?php

namespace App\Providers;

use App\Events\SlugEvent;
use App\Events\TrickTimeStampEvent;
use App\Listeners\SlugListener;
use App\Listeners\TrickTimeStampListener;
use App\Models\AssignedProject;
use App\Models\Escalate;
use App\Models\Project;
use App\Models\Result;
use App\Observers\AssignedProjectObserver;
use App\Observers\EscalateObserver;
use App\Observers\ProjectObserver;
use App\Observers\ResultObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SlugEvent::class => [
            SlugListener::class,
        ],
        TrickTimeStampEvent::class => [
            TrickTimeStampListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Project::observe(ProjectObserver::class);
        Result::observe(ResultObserver::class);
        Escalate::observe(EscalateObserver::class);
        AssignedProject::observe(AssignedProjectObserver::class);
    }
}
