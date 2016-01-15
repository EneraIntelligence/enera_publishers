<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\Network
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Publishers\Branche[] $branches
 * @property-read mixed $id
 */
class Network extends Model
{
    protected $fillable = ['name', 'type', 'main', 'status'];

    // relations
    public function branches()
    {
        return $this->hasMany('Publishers\Branche');
    }
    // end relations
}
