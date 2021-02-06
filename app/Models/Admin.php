<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use  Notifiable;
    use SoftDeletes;

    protected $table = "admins";

    protected $guarded = [];

    public $timestamps = true;


     //SCOPES
     public function scopeNotdelete($qry)
     {
         return $qry->where('deleted_at',null);
     }
}


