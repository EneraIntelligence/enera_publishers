<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

class Campaign extends Model
{
    protected $fillable = ['client_id', 'administrator_id', 'name', 'branches', 'interaction', 'filter', 'content',
        'log', 'status'];

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
    // end relations
}
