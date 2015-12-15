<?php

namespace Publishers\Jobs;

use Mail;
use Publishers\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Publishers\Subcampaign;

class mailingJob extends Job implements SelfHandling
{
    protected $data;
    protected $email;
    /**
     * Create a new job instance.
     *
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

        //save subcampaign on DB
        $subCampaign = new Subcampaign();
        $subCampaign->administrator_id = $this->data['admin_id'];
        $subCampaign->campaign_id = $this->data['campaign_id'];
        $subCampaign->name = $this->data['campaign_name'];
        $subCampaign->from = $this->data['from'];
        $subCampaign->from_mail = $this->data['from_mail'];
        $subCampaign->subject = $this->data['subject'];
        $subCampaign->content = $this->data['content'];
        $subCampaign->mailing = $this->data['mail'];
        $subCampaign->save();

        //setup mail data
        $mail = array(
            "from" => $this->data['from'],
            "from_mail" => $this->data['from_mail'],
            "subject" => $this->data['subject'],
            "content" => $this->data['content']
        );


        foreach($subCampaign->mailing as $email) {
            Mail::send('emails.test', ['content' => $mail["content"]], function ($m) use ($mail, $email) {
                $m->from($mail["from_mail"], $mail["from"]);
                //TODO tomar mails de campaña y mandar a todos
                $m->to($email, $email)->subject($mail["subject"]);
            });
        }
    }
}
