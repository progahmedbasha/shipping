<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $table = "suppliers";

    protected $guarded = [];

    public $timestamps = true;


    // RELATIONS 

    // ONE TO MANY WITH PRODUCTS 
    public function products()
    {
        return $this->hasMany('App\Models\Products');
    }
    // ONE TO MANY WITH CITIES 
    public function cities()
    {
        return $this->belongsTo('App\Models\City', 'city_id')->withTrashed();
    }
}
