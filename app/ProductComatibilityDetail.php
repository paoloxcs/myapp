<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductComatibilityDetail extends Model
{
    protected $table = 'product_compatibilities_detail';
    protected $fillable = ['name','static','dynamic','compatibility_id'];
    public $timestamps = false;

    // Relacion con la compatibilidad
    public function compatibility()
    {
        return $this->belongsTo(ProductComatibility::class,'compatibility_id');
    }
}
