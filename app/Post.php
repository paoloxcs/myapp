<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   
    
    protected $fillable =['title','slug','summary','body','user_id','status', 'post_type']; //Asignación de campos a ingresar y su orden
    // public $timestamps=false; //Si las tablas no tuviesen campos CREATED_AT y UPDATED_AT

    // Relacion con otras tablas
    public function user()
    {
    	return $this->belongsTo(User::class,'user_id');
    }

    public function images()
    {
    	return $this->hasMany(PostImage::class);
    }

    public function getMainImage()
    {
        return $this->images()->where('is_main','=',1)->first();
    }
}
