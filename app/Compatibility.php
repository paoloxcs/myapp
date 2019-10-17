<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compatibility extends Model
{
    protected $table = 'compatibilities';
    protected $fillable = ['name','level','parent_id'];
    public $timestamps = false;


    // Relacion con el compatibilidades del producto
    public function product_compatibilities()
    {
        return $this->hasMany(ProductComatibility::class);
    }
}
