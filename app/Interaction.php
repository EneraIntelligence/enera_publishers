<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

class Interaction extends Model
{
    protected $fillable = ['name', 'rules', 'status'];

    // relations
    public function campaigns()
    {
        return $this->hasMany('Publishers\Campaign', 'interaction.id');
    }
    // end relations
}
