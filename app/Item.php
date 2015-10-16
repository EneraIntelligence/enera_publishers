<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

class Item extends Model
{
    protected $fillable = ['campaign_id', 'filename', 'type'];
}
