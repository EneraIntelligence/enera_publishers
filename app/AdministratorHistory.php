<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\AdministratorHistory
 *
 * @property-read mixed $id
 */
class AdministratorHistory extends Model
{
    protected $fillable = ['previous_status'];
    protected $table = null;
    protected $collection = null;
    // relations

    // end relations
}
