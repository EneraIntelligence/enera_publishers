<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\Branche
 *
 * @property-read \Publishers\Network $network
 * @property-read mixed $id
 */
class Branche extends Model
{
    protected $fillable = ['name', 'network_id', 'portal', 'aps', 'status'];

    // relations
    public function network()
    {
        return $this->belongsTo('Publishers\Network');
    }

    public function campaign_logs()
    {
        return $this->hasMany('Publishers\CampaignLog', 'device.branch_id');
    }
    // end relations
}
