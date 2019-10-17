<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductComatibility extends Model
{
    protected $table = 'product_compatibilities';
    protected $fillable = ['name','static','dynamic','compatibility_id','product_id'];
    public $timestamps = false;

    // Relacion con la compatibilidad
    public function compatibility()
    {
        return $this->belongsTo(ProductComatibility::class,'compatibility_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
