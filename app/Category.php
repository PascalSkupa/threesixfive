<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pk_category_id', 'name',
    ];
    
    protected $primaryKey = 'pk_category_id';
    
    public function plan() {
        return $this->hasMany('App\NoGo');
    }
}
