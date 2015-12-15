<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

class Campaign extends Model
{
    protected $fillable = ['client_id', 'administrator_id', 'name', 'branches', 'interaction', 'filters', 'content', 'status'];

    // relations
    public function administrator()
    {
        return $this->belongsTo('Publishers\Administrator');
    }

    public function interaction()
    {
        return $this->belongsTo('Publishers\Interaction', 'interaction.id');
    }

    public function logs()
    {
        return $this->hasMany('Publishers\CampaignLog');
    }

    public function history()
    {
        return $this->embedsMany('Publishers\CampaignHistory', 'history');
    }
    // end relations
}
