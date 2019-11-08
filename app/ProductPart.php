<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPart extends Model
{
    protected $table = 'product_parts';
    protected $fillable = ['part_nro','dimensions','measurement_id','product_id','ruta'];

    public $timestamps = false;

    // Ralcion con producto
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    // Relacion con unidad de medida
    public function measurement()
    {
        return $this->belongsTo(Measurement::class, 'measurement_id');
    }
}
