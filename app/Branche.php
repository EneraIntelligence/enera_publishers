<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

class Branche extends Model
{
    protected $fillable = ['name', 'network_id', 'portal', 'aps', 'status'];

    // relations
    public function network()
    {
        return $this->belongsTo('Publishers\Network');
    }
    // end relations
}
