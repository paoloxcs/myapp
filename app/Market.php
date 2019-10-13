<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable =['name','slug','url_image'];

    public $timestamps = false;

    public function products()
    {
    	return $this->belongsToMany(Product::class,'market_product');
    }

    public function getUrlImageAttribute($value)
    {
        return url('/').'/allimages/'.$value;
    }
}
