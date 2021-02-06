<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    // USE TRANSLATION PACKAGE
    use Translatable;

    protected $with = ['translations'];

    // TO KNOW WITCH COLUMN IS WILL TRANSLATE IN CATEGORY TRANSLATION TABLE

    protected $translatedAttributes = ['name'];

    // CALL TABLE NAME AND COLUMNS
    protected $table = "categories";
    protected $fillable = 
    [
        'parent_id','slug','is_active'
    ];

    // TO MAKE TRANSLATABLE DATE UNRETURN WITH DATE AS ADEFULT
    protected $hidden = ['translations'];

    //TO MAKE ACTIVE VALUE == TRUE OR FALSE 
    protected $casts =['is_active' => 'boolean'];


    //SCOPES
    public function scopeParient($qry)
    {
        return $qry->where('parent_id',null);
    }

    public function scopeChild($qry)
    {
        return $qry->whereNotNull('parent_id');
    }

    public function Status()
    {
       return $this->is_active == 1 ? 'Active' : 'Not Active';
    }

    public function scopeActive($qry)
    {
        return $qry->where('is_active',1);
    }

    public function scopeSelect($qry)
    {
        return $qry->select('id','name');
    }


    // RELATIONS
     public function CATEGORY()
     {
        return $this->belongsTo(self::class,'parent_id');
     }

    //  MANY TO MANY WITH PRODUCT MODEL
     public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
