<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\CampaignHistory
 *
 * @property-read mixed $id
 */
class CampaignHistory extends Model
{
    protected $fillable = ['administrator_id', 'status', 'date', 'note'];
    protected $collection = null;
    protected $dates = ['date'];
    // relations

    // end relations
}
