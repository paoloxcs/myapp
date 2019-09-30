<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $fillable =['url_image','is_main','post_id'];
    public $timestamps = false;

    // Relaciones con otras tablas

    public function post()
    {
    	return $this->belongsTo(Post::class,'post_id');
    }

    // Mutators
    public function getUrlImageAttribute($value)
    {
        return url('/').'/allimages/'.$value;
    }
}
