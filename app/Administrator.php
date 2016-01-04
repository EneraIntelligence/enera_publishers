<?php

namespace Publishers;

use Jenssegers\Mongodb\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Administrator extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database collection used by the model.
     *
     * @var string
     */
    protected $table = 'administrators';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'rol_id','client_id', 'status', 'wallet','history'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    // relations
    public function client()
    {
        return $this->belongsTo('Publishers\Client');
    }

    public function role()
    {
        return $this->belongsTo('Publishers\Role');
    }

    public function campaigns()
    {
        return $this->hasMany('Publishers\Campaign');
    }

    public function subcampaigns()
    {
        return $this->hasMany('Publishers\Subcampaign');
    }

    public function wallet()
    {
        return $this->embedsOne('Publishers\AdministratorWallet');
    }

    public function movements()
    {
        return $this->hasMany('Publishers\AdministratorMovement');
    }

    public function history()
    {
        return $this->embedsMany('Publishers\AdministratorHistory');
    }
    // end relations
}
