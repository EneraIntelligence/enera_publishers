<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

class GiftCard extends Model
{
    protected $fillable = ['code', 'amount', 'filters', 'status', 'deadline'];
    // relations

    // end relations
}
