<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMaterial extends Model
{
    protected $table = 'product_materials';
    protected $fillable = ['options','name','type','colour','product_id'];

    public $timestamps = false;


    // Relacion con producto
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');   
    }
}
