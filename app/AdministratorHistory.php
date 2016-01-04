<?php

namespace Publishers;

use Illuminate\Database\Eloquent\Model;

class AdministratorHistory extends Model
{
    protected $fillable = ['previous_status'];
    protected $table = null;
    protected $collection = null;
    // relations

    // end relations
}
