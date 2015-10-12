<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

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
