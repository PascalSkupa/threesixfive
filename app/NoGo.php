<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoGo extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_n_user_id', 'fk_object', 'which',
    ];
    
    protected $primaryKey = 'pk_nogo_id';
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function allergens() {
        return $this->belongsTo('App\Allergen');
    }
    
    public function category() {
        return $this->belongsTo('App\Category');
    }
}
