<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\FacebookPage
 *
 * @property-read mixed $id
 */
class FacebookPage extends Model
{
    protected $fillable = ['name', 'category'];
    // relations

    // end relations
}
