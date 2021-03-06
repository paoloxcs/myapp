<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = ['name','sigla'];

    public $timestamps = false;

    // Relaciones
    public function products()
    {
        return $this->belongsToMany(Product::class,'measurement_product');
    }

    // Relacion con partes
    public function parts()
    {
        return $this->hasMany(ProductPart::class);
    }

    // Relacion con condiciones de operatividad del producto
    public function product_operating_conditions()
    {
        return $this->hasMany(ProductOperatingCondition::class);
    }


    
}
