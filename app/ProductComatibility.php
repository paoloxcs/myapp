<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductComatibility extends Model
{
    protected $table = 'product_compatibilities';
    protected $fillable = ['name','product_id'];
    public $timestamps = false;

    // Relacion con producto
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    // Relacion con el detalle
    public function details()
    {
        return $this->hasMany(ProductComatibilityDetail::class);
    }
}
