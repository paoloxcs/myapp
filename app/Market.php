<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable =['name','slug','url_image'];

    public $timestamps = false;

    public function profiles()
    {
    	return $this->belongsToMany(Profile::class,'markets_profiles');
    }

    public function getUrlImageAttribute($value)
    {
        return url('/').'/allimages/'.$value;
    }
}
