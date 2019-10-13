<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    protected $fillable = ['name','sigla','slug'];
    public $timestamps = false;


    // Relacion con productos
    public function products()
    {
        return $this->belongsToMany(Product::class, 'dimension_product');
    }

}
