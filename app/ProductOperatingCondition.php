<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOperatingCondition extends Model
{
    protected $table = 'product_operating_conditions';
    protected $fillable = ['name','metric','inch','product_id'];

    public $timestamps = false;

    // Relacion con producto
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
