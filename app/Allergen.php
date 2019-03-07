<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pk_allergen_id', 'shortcut', 'description',
    ];
    
    protected $primaryKey = 'pk_allergen_id';
    
    public function plan() {
        return $this->hasMany('App\Nogo');
    }
}
