<?php

namespace Publishers;

use Carbon\Carbon;
use Jenssegers\Mongodb\Model;

/**
 * Publishers\GiftCard
 *
 * @property-read mixed $id
 */
class GiftCard extends Model
{
    protected $fillable = ['code', 'amount', 'filters', 'status'];
    protected $dates = ['created_at', 'updated_at', 'filters.dateline'];

    // relations
    /**
     * @property-read Carbon\Carbon $getDeadline
     * @return null|static
     */
    public function getDeadline()
    {
        if (isset($this->filters['deadline'])) {
            return Carbon::createFromTimestamp($this->filters['deadline']->sec);
        } else {
            return null;
        }
    }
    // end relations
}
