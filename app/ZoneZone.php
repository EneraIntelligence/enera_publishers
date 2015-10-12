<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

class ZoneZone extends Model
{
    protected $fillable = ['name', 'aps', 'zone'];
    protected $collection = null;

    // relations
    public function zones()
    {
        return $this->embedsMany('Publishers\ZoneZone');
    }
    // end relations
}
