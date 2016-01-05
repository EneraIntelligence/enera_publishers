<?php

namespace Publishers\Jobs;

use Mail;
use Publishers\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class MailCreationJob extends Job implements SelfHandling
{

    protected $camp;
    /**
     * Create a new job instance.
     *
     * @param $camp
     */
    public function __construct($camp)
    {
        $this->camp = $camp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('emails.creation', ['camp' => $this->camp], function ($m) {
            $m->from('servers@enera.mx', 'Enera Publisher');
            $m->to('contacto@enera.mx', 'Notificaciones')->subject('Campaña creada');
        });
    }
}
