<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $fillable=['name','url_image', 'ruta', 'edicion', 'brand_id'];
    public $timestamps=false;

    public function brand()
    {
    	return $this->belongsTo(Brand::class, 'brand_id');
    }
}
