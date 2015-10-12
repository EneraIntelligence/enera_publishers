<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

class FacebookPage extends Model
{
    protected $fillable = ['name', 'category'];
    // relations

    // end relations
}
