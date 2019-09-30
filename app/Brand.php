<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable =['name','slug','url_image','status'];
    
    public $timestamps = false;

    public function getUrlImageAttribute($value)
    {
        return url('/').'/allimages/'.$value;
    }
}
