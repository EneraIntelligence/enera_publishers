<?php

namespace Publishers;

use Illuminate\Database\Eloquent\Model;

class AccessPoint extends Model
{
    protected $fillable = ['name', 'mac', 'serial_number', 'location', 'branch_id', 'network_id', 'historic', 'status'];

    // relations
    public function branche()
    {
        return $this->belongsTo('Publishers\Branche');
    }

    public function network()
    {
        return $this->belongsTo('Publishers\Network');
    }
    // end relations
}
