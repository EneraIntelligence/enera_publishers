<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\ValidationCode
 *
 * @property-read mixed $id
 */
class ValidationCode extends Model
{
    protected $fillable = ['administrator_id', 'type', 'token'];
    //
}
