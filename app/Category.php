<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ='categories';

    protected $fillable =['name','slug','description','url_image','status'];

    public $timestamps = false;

    // Relacion con productos
    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    // Relacion con videos
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    // Mutador para url_image
    public function getUrlImageAttribute($value)
    {
    	return url('/').'/allimages/'.$value;
    }

}
