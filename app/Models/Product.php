<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model 
{
    use SoftDeletes;

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('resever_name', 'resver_phone', 'supplier_id', 'city_id', 'adress', 'product_price', 'status_id', 'notes');

    

    public function cities()
    {
        return $this->belongsTo('App\Models\City', 'city_id')->withTrashed();
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id')->withTrashed();
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id')->withTrashed();
    }

    public function ordersDetailes()
    {
        return $this->hasMany('App\Models\OrderDetailes')->withTrashed();
    }

}