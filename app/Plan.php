<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pk_date', 'pk_fk_user_id', 'weekday', 'breakfast', 'lunch', 'dinner', 'snack',
    ];
    
    protected $primaryKey = ['pk_date', 'pk_fk_user_id'];
    
    public function plan() {
        return $this->hasOne('App\User');
    }
}
