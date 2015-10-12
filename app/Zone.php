<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

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
