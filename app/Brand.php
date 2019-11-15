<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable =['name','slug','url_image','status'];
    
    public $timestamps = false;

    // Relacion catalogos 
    public function catalogs()
    {
        return $this->hasMany(Catalog::class);
    }

    // Mutador para url_image
    public function getUrlImageAttribute($value)
    {
        return url('/').'/allimages/'.$value;
    }
}
