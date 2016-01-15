<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\Device
 *
 * @property-read mixed $id
 */
class Device extends Model
{
    protected $fillable = ['mac', 'os', 'manufacture', 'frecuency'];
    // relations

    // end relations
}
