<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','slug','summary','body','url_image','status','category_id'];

    
    // Relacion con unidades de medida
    public function measurements()
    {
        return $this->belongsToMany(Measurement::class,'measurement_product');

    }
    // Relacion con dimensiones
    public function dimensions()
    {
        return $this->belongsToMany(Dimension::class,'dimension_product');
    }
    // Relacion con categoria
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    // Relacion con mercados
    public function markets()
    {
        return $this->belongsToMany(Market::class,'market_product');
    }
    // Relacion con compatibilidad
    public function compatibilities()
    {
        return $this->hasMany(ProductComatibility::class);
    }
    // Relacion con documentos (pdf)
    public function docs()
    {
        return $this->hasMany(ProductDoc::class);
    }
    // Relacion con materiales
    public function materials()
    {
        return $this->hasMany(ProductMaterial::class);
    }
    // Relacion con condiciones de operatividad
    public function operating_conditions()
    {
        return $this->hasMany(ProductOperatingCondition::class);
    }
    // Relacion con partes
    public function parts()
    {
        return $this->hasMany(ProductPart::class);
    }

    // Mutador para la imagen 
    public function getUrlImageAttribute($value)
    {
        return url('/').'/allimages/'.$value;
    }


}
