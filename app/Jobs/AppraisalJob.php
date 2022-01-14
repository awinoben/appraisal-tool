<?php

namespace App\Jobs;

use App\Models\User;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptions;
use Illuminate\Queue\SerializesModels;

class AppraisalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        User::query()
            ->whereNotIn('email', ['admin@javahouseafrica.com'])
            ->orderBy('created_at')
            ->chunk(200, function ($users) {
                foreach ($users as $user) {
                    $user->password = bcrypt($user->employee_number);
                    $user->save();

                    // dispatch an email here
                    dispatch(new MailJob(
                        $user->email,
                        'Announcement - Performance Development Plan',
                        $user->name,
                        "We are excited to announce that we’re rolling out our performance development planning process. This is part of our ongoing effort to support employee development and is also an opportunity for self-reflection, feedback, and getting aligned with your manager on next steps and expectations for the coming year. Shortly, you will receive an email with the login link and credentials.",
                    ))->onQueue('emails')->delay(1);

                    // dispatch an email here
                    dispatch(new MailJob(
                        $user->email,
                        'Java House PDP Account & Tutorial',
                        $user->name,
                        "Your account username is '.$user->email.', Your account password is '.$user->employee_number.' .Kindly use it to log in by clicking on the link below.",
                        env('FRONTEND_URL'),
                        '<<< LOGIN >>>',
                        "Click on the link below for a tutorial on how to fill in your appraisal - https://stonly.com/guide/en/self-evaluation-LNVE0e1CAu/Steps/697676"
                    ))->onQueue('emails')->delay(10);
                }
            });
    }
}
