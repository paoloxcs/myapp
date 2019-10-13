<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPart extends Model
{
    protected $table = 'product_parts';
    protected $fillable = ['key_field','value_field','measurement_id','product_id'];

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
    // Relacion isos
    public function isos()
    {
        return $this->belongsToMany(Iso::class,'iso_part','part_id','iso_id');
    }
}
