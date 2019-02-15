<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDiet extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pk_fk_d_user_id', 'pk_fk_u_diet_id', 
    ];
    
    protected $primaryKey = 'pk_fk_d_user_id';
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function diet() {
        return $this->belongsTo('App\Diet');
    }
}
