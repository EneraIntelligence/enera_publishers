<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\Payment
 *
 * @property-read \Publishers\Administrator $admin
 * @property-read \Publishers\AdministratorMovement $movement
 * @property-read mixed $id
 */
class Payment extends Model
{
    protected $fillable = ['amount', 'type', 'movement_id', 'status', 'invoice', 'history',
        'paypal', 'giftcard', 'conekta'];

    // relations
    public function admin()
    {
        return $this->belongsTo('Publishers\Administrator');
    }

    public function movement()
    {
        return $this->belongsTo('Publishers\AdministratorMovement', 'movement_id');
    }

    public function history()
    {
        return $this->embedsMany('Publishers\AdministratorHistory');
    }
    // end relations
}
