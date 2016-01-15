<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

/**
 * Publishers\Subcampaign
 *
 * @property-read \Publishers\Administrator $administrator
 * @property-read mixed $id
 */
class Subcampaign extends Model
{
    protected $fillable = ['administrator_id', 'name', 'from', 'from_mail', 'campaign_id', 'subject', 'content'];

    // relations
    public function administrator()
    {
        return $this->belongsTo('Publishers\Administrator');
    }
}
