<?php

namespace Publishers;

use Jenssegers\Mongodb\Model as Model;

class CampaignLog extends Model
{
    protected $fillable = ['user', 'device', 'interaction', 'cost'];

    // relations
    public function campaign()
    {
        return $this->belongsTo('Publishers\Campaign');
    }

    public function interaction()
    {
        return $this->embedsOne('Publishers\CampaignLogInteraction');
    }
    // end relations
}