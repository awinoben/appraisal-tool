<?php

namespace App\Jobs;

use App\Http\Controllers\SystemController;
use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptions;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class SyncUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private array  $datas,
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
        $count = 0;
        foreach ($this->datas as $datum) {
            try {
                // generate a unique password for each user
                $password = (string)$datum['employee_number'];

                // fetch the role and the branch
                $branch = Branch::query()->firstWhere('slug', Str::slug($datum['cost center']));
                $role = Role::query()->firstWhere('slug', Str::slug($datum['employee_designation']));

                if (!$branch) {
                    $branch = Branch::query()->updateOrCreate([
                        'name' => $datum['cost center']
                    ]);
                }
                if (!$role) {
                    $role = Role::query()->updateOrCreate([
                        'name' => $datum['employee_designation']
                    ], [
                        'level' => 3,
                        'description' => 'Give more details on what the ' . $datum['employee_designation'] . ' does within the system.'
                    ]);
                }

                if ($branch && $role) {
                    // check if user exists
                    $user = new User();

                    $user_check = $user->newQuery()->firstWhere('employee_number', (string)$datum['employee_number']);
                    $user_check?->update([
                        'email' => Str::lower(str_replace(' ', '', $datum['email'])),
                        'role_id' => $role->id,
                        'branch_id' => $branch->id,
                        'country_id' => $this->country_id,
                        'name' => $datum['name'],
                        'employee_designation' => $datum['employee_designation'],
                        'joining_date' => !is_null($datum['joining_date']) ? Carbon::parse($datum['joining_date'])->format('d-m-Y') : null,
                        'password' => bcrypt($password),
                        'email_verified_at' => now()
                    ]);

                    // check
                    $exists = $user
                        ->newQuery()
                        ->whereNotNull('email')
                        ->where(function ($query) use ($datum) {
                            $query->orWhere('email', Str::lower(str_replace(' ', '', $datum['email'])))
                                ->orWhere('employee_number', (string)$datum['employee_number']);
                        })
                        ->first();

                    if (!$exists) {
                        // create new user here
                        $member = $user->newQuery()->create([
                            'employee_number' => $datum['employee_number'],
                            'email' => Str::lower(str_replace(' ', '', $datum['email'])),
                            'role_id' => $role->id,
                            'branch_id' => $branch->id,
                            'country_id' => $this->country_id,
                            'name' => $datum['name'],
                            'employee_designation' => $datum['employee_designation'],
                            'joining_date' => !is_null($datum['joining_date']) ? Carbon::parse($datum['joining_date'])->format('d-m-Y') : null,
                            'password' => bcrypt($password),
                            'email_verified_at' => now()
                        ]);

                        // welcome email
                        dispatch(new MailJob(
                            $member->email,
                            'Announcement - Performance Development Plan',
                            $member->name,
                            "We are excited to announce that we’re rolling out our performance development planning process. This is part of our ongoing effort to support employee development and is also an opportunity for self-reflection, feedback, and getting aligned with your manager on next steps and expectations for the coming year. Shortly, you will receive an email with the login link and credentials.",
                        ))->onQueue('emails')->delay(0.5);

                        // check if email is present
                        if (!is_null($member->email)) {
                            // dispatch an email here
                            dispatch(new MailJob(
                                $member->email,
                                'Java House PDP Account & Tutorial',
                                $member->name,
                                "Your account username is '.$member->email.', Your account password is '.$password.' .Kindly use it to log in by clicking on the link below.",
                                env('FRONTEND_URL'),
                                '<<< LOGIN >>>',
                                "Click on the link below for a tutorial on how to fill in your appraisal - https://stonly.com/guide/en/self-evaluation-LNVE0e1CAu/Steps/697676"
                            ))->onQueue('emails')->delay(1);
                        }

                        $count++;
                    }
                }
            } catch (Exception $exception) {
                SystemController::log([
                    'exception' => $exception->getMessage(),
                    'uploaded' => number_format($count)
                ], 'error', 'upload-error');
                continue;
            }
        }
    }
}
