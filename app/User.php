<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\User
 *
 * @property-read mixed $id
 */
class User extends Model
{
    protected $fillable = ['facebook'];

    // relations
    public function facebook()
    {
        return $this->embedsOne('Publishers\UserFacebook');
    }
    // end relations
}
