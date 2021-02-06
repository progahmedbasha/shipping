<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Returns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnsDetailes extends Model
{
    use SoftDeletes;


    protected $table = 'returns_detailes';
    public $timestamps = true;
    protected $guarded = [];

   
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id')->withTrashed();
    }

    public function returns()
    {
        return $this->belongsTo(Returns::class,'returns_id')->withTrashed();
    }

    public function orders()
    {
        return $this->belongsTo(Order::class,'returns_id')->withTrashed();
    }

}
