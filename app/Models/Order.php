<?php

namespace App\Models;

use App\Models\OrderDetailes;
use App\Models\ReturnsDetailes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model 
{
    use SoftDeletes;

    protected $table = 'orders';
    public $timestamps = true;
    protected $guarded = [];

    public function servant()
    {
        return $this->belongsTo('App\Models\Servant', 'servant_id')->withTrashed();
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id')->withTrashed();
    }

    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate', 'governorate_id')->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id')->withTrashed();
    }

    public function ordersDetailes()
    {
        return $this->hasMany(OrderDetailes::class)->withTrashed();
    }
    public function returnsDetailes()
    {
        return $this->hasMany(ReturnsDetailes::class)->withTrashed();
    }
}