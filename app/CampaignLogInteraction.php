<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\CampaignLogInteraction
 *
 * @property-read mixed $id
 */
class CampaignLogInteraction extends Model
{
    protected $fillable = ['welcome', 'joined', 'requested', 'loaded', 'completed'];
    protected $collection = null;
    // relations

    // end relations
}
