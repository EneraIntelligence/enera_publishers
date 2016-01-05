<?php

namespace Publishers;

use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    protected $fillable = ['code', 'amount', 'filters', 'status', 'deadline'];
    // relations

    // end relations
}
