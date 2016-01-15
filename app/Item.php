<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\Item
 *
 * @property-read mixed $id
 */
class Item extends Model
{
    protected $fillable = ['campaign_id', 'filename', 'type', 'administrator_id'];
}
