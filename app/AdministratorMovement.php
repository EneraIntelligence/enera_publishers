<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\AdministratorMovement
 *
 * @property-read \Publishers\Administrator $admin
 * @property-read \Publishers\Client $client
 * @property-read \Publishers\AdministratorMovement $reference
 * @property-read \Publishers\Payment $payment
 * @property-read mixed $id
 */
class AdministratorMovement extends Model
{
    protected $fillable = ['administrator_id', 'client_id', 'movement', 'reference_id', 'reference_type', 'amount', 'balance'];

    // relations
    public function admin()
    {
        return $this->belongsTo('Publishers\Administrator');
    }

    public function client()
    {
        return $this->belongsTo('Publishers\Client');
    }

    public function reference()
    {
        return $this->morphTo();
    }

    public function payment()
    {
        return $this->hasOne('Publishers\Payment', 'movement_id');
    }
    // end relations
}
