<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'title', 'email', 'password', 'api_token',
    ];
    
    protected $hidden = [
        'password', 'pk_user_id'
    ];
    
    protected $primaryKey = 'pk_user_id';

    public function plan() {
        return $this->hasOne('App\Plan');
    }
    
    public function nogo() {
        return $this->hasMany('App\NoGo');
    }
    
    public function user_diet() {
        return $this->hasMany('App\UserDiet');
    }
    
    public function groceries() {
        return $this->hasMany('App\Grocery');
    }
}
