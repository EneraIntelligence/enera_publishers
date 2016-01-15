<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\UserFacebook
 *
 * @property-read mixed $id
 */
class UserFacebook extends Model
{
    protected $fillable = ['name', 'birthday', 'email', 'location', 'gender', 'likes', 'id'];
    protected $collection = null;

    // relations

    // end relations
}
