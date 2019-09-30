<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ='categories';

    protected $fillable =['name','slug','description','url_image','status'];

    public $timestamps = false;

    public function profiles()
    {
    	return $this->hasMany(Profile::class);
    }

    public function getUrlImageAttribute($value)
    {
    	return url('/').'/allimages/'.$value;
    }

    public function video()
    {
        return $this->hasMany(Video::class);
    }

}
