<?php

namespace Publishers\Jobs;

use Mail;
use Publishers\Jobs\Job;
use Publishers\Administrator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class newAdminJob extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data = array();
    protected $correo;
    protected $nombre;

    /**P
     * Create a new job instance.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $correo = $this->data['email'];
        $nombre = $this->data['nombre'] . ' ' . $this->data['apellido'];

        Mail::send('emails.verify', ['data' => $this->data], function ($message) use ($correo, $nombre) {
            $message->from('notificacion@enera.mx', 'Enera Intelligence');
            $message->to($correo, $nombre)->subject('Confirmacion de registro');
        });
    }
}
