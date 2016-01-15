<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\PaymentHistory
 *
 * @property-read mixed $id
 */
class PaymentHistory extends Model
{
    protected $fillable = ['status', 'error', 'msg'];
    protected $table = null;
    protected $collection = null;
    // relations

    // end relations
}
