<?php

namespace Publishers\Console\Commands;

use Auth;
use Exception;
use Illuminate\Console\Command;
use Mail;
use MongoDate;
use Publishers\Administrator;
use Publishers\Campaign;
use Publishers\User;
use Symfony\Component\Console\Helper\Table;


class TimeEndEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enera:timeEnd';
    protected $user;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mandar Correo de notificación de fin de campaña';

    /**
     * Create a new command instance.
     *
     * @param $user $drip
     */
    public function __construct()
    {
        parent::__construct();

        //
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        try {
            $this->info('------------ Mandando Correo de Notificación -------------');
            $today = date('Y-m-d h:m:s');

            $campaigns = Campaign::where('status', 'active')
                ->whereRaw([
                    'filters.date.end' => [
                        '$lt' => new MongoDate(strtotime($today))
                    ]
                ])
                ->get();
//            dd($campaigns);

            foreach ($campaigns as $key => $cam) {
                $cam->status = 'ended';
                $cam->save();
                $cam->history()->create(array('administrator_id' => '0', 'status' => 'ended', 'date' => $today, 'note' => 'Campaña finalizada por fecha de terminación'));

                $user = Administrator::find($cam->administrator_id);

                Mail::send('emails.notifications', ['user' => $user], function ($m) use ($user) {
                    $m->from('soporte@enera.mx', 'Enera Intelligence');
                    $m->to($user->email, $user->name['first'] . ' ' . $user->name['last'])->subject('Terminacion de Camapaña');
                });
                $key += 1;
                $this->info('             Correo # '.$key.' enviado  ' . $user->email . '              ');
            }
            $this->info('-------------------- Fin de comando ----------------------');


        } catch (Exception $e) {
            $this->error($e);
        }
    }

}
