<?php

namespace Publishers;

use Jenssegers\Mongodb\Model as Model;

class Issue extends Model
{
    protected $fillable = ['msg', 'request', 'file', 'exception', 'responsible_id', 'priority', 'status', 'history'];
    protected $dates = ['created_at', 'updated_at'];

    // relations
    public function reponsible()
    {
        return $this->belongsTo('Publishers\Administrator', 'responsible_id');
    }
    // end relations
}
