<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\Client
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Publishers\Administrator[] $administrators
 * @property-read mixed $id
 */
class Client extends Model
{
    protected $fillable = ['name', 'billing_information'];

    // relations
    public function administrators()
    {
        return $this->hasMany('Publishers\Administrator');
    }
    // end relations

}
