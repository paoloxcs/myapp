<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCompatibility extends Model
{
    protected $table = 'product_compatibilities';
    protected $fillable = ['name','type_field','value_field','compatibility_id','product_id'];
    public $timestamps = false;

    // Relacion con la compatibilidad
    public function compatibility()
    {
        return $this->belongsTo(Compatibility::class,'compatibility_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
