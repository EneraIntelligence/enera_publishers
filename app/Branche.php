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
    // end relations
}
