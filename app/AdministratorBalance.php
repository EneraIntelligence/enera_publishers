<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;

class AdministratorBalance extends Model
{
    protected $fillable = ['current'];
    protected $table = null;
    protected $collection = null;
    //
}
