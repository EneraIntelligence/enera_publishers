<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

class Subcampaign extends Model
{
    protected $fillable = ['campaign_id', 'subject', 'content'];
}
