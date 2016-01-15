<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\Role
 *
 * @property-read \Publishers\Client $client
 * @property-read mixed $id
 */
class Role extends Model
{
    protected $fillable = ['name', 'platform', 'permissions', 'client_id'];

    // relations
    public function client()
    {
        return $this->belongsTo('Publishers\Client');
    }
    // end relations
}
