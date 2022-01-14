<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Snowfire\Beautymail\Beautymail;

class MailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param string $email
     * @param string $title
     * @param string $name
     * @param string $body
     * @param string|null $url
     * @param string|null $action
     */
    public function __construct(
        private string      $email,
        private string      $title,
        private string      $name,
        private string      $body,
        private string|null $url = null,
        private string|null $action = null,
        private string|null $body_2 = null,
    )
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function handle()
    {
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.mail', [
            'title' => $this->title,
            'body' => $this->body,
            'body_2' => $this->body_2,
            'url' => $this->url,
            'action' => $this->action,
            'name' => $this->name,
        ], function ($message) {
            $message
                ->from(env('MAIL_FROM_ADDRESS'))
                ->to($this->email, $this->name)
                ->subject($this->title);
        });
    }
}
