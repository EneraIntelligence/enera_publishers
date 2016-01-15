<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\Zone
 *
 * @property-read \Publishers\Network $network
 * @property-read mixed $id
 */
class Zone extends Model
{
    protected $fillable = ['name', 'aps', 'network_id', 'zones'];

    // relations
    public function network()
    {
        return $this->belongsTo('Publishers\Network');
    }

    public function zones()
    {
        return $this->embedsMany('Publishers\ZoneZone');
    }
    // end relations
}
