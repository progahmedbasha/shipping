<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Returns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetailes extends Model 
{
    use SoftDeletes;


    protected $table = 'order_detailes';
    public $timestamps = true;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id')->withTrashed();
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id')->withTrashed();
    }

    public function returns()
    {
        return $this->belongsTo(Returns::class,'order_id')->withTrashed();
    }

}