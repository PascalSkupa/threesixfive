<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pk_diet_id', 'bezeichnung',
    ];
    
    protected $primaryKey = 'pk_diet_id';
    
    public function plan() {
        return $this->hasMany('App\UserDiet');
    }
}
