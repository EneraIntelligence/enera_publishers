<?php

namespace Publishers\Jobs;

use Mail;
use Publishers\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Publishers\User;

class EmailJob extends Job implements SelfHandling
{
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::findOrFail($this->user);

        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {

            $m->from('hello@app.com', 'Your Application');
            $m->to($user->email, $user->name)->subject('Your Reminder!');

        });
    }
}
