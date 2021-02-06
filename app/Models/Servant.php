<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servant extends Model 
{
    use SoftDeletes;

    protected $table = 'servants';
    public $timestamps = true;
    protected $fillable = array('name', 'adress', 'phone', 'age');

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function returns()
    {
        return $this->hasMany('App\Models\Returns');
    }

}