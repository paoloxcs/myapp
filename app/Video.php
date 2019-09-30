<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $fillable =['nombre','categoria_id','embed','url_image']; //Asignación de campos a ingresar y su orden
    public $timestamps=false; //Si las tablas no tuviesen campos CREATED_AT y UPDATED_AT

    //Relación con otras tablas
    public function category()
    {
    	return $this->belongsTo(Category::class,'categoria_id');
    }
}
