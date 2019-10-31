<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOperatingCondition extends Model
{
    protected $table = 'product_operating_conditions';
    protected $fillable = ['max_pressure','min_temp','max_temp','max_speed','product_id','measurement_id'];

    public $timestamps = false;

    // Relacion con producto
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relacion con unidad de medida
    public function measurement()
    {
        return $this->belongsTo(Measurement::class, 'measurement_id');
    }
}
