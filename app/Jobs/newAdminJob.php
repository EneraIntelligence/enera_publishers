<?php

namespace Publishers\Jobs;

use Publishers\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class newAdminJob extends Job implements SelfHandling
{
    protected $data;
    protected $email;

    /**
     * Create a new job instance.
     *
     */
    public function __construct($data)
    {
        //
        $this->data=$data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //

    }
}
