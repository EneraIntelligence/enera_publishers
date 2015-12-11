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

        $user = Administrator::find($user->administrator_id);
        Mail::send('emails.notifications', ['user' => $user], function ($m) use ($user) {
            $m->from('notificacion@enera.mx', 'Enera Intelligence');
            $m->to($user->email, $user->name['first'] . ' ' . $user->name['last'])->subject('Terminacion de Camapaña');
        });
    }
}
