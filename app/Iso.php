<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iso extends Model
{
    protected $fillable = ['name','description'];

    public $timestamps = false;

    // Relacion con productos
    public function product()
    {
        return $this->belongsToMany(Product::class,'iso_product','iso_id','product_id');
    }
}
