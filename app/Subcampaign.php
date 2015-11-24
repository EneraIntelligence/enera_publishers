<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

class Subcampaign extends Model
{
    protected $fillable = ['from', 'from_mail', 'campaign_id', 'subject', 'content'];
}
