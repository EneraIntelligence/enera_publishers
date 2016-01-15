<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\Interaction
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Publishers\Campaign[] $campaigns
 * @property-read mixed $id
 */
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
