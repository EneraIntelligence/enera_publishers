<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

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

    public function user() // presenta inconsistencia
    {
        return $this->belongsTo('Publishers\User', 'user.id');
    }
    // end relations


}