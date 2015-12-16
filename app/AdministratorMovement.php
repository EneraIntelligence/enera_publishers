<?php

namespace Publishers;

use Illuminate\Database\Eloquent\Model;

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
    // end relations
}
