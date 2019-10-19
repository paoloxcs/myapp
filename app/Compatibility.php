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
        return $this->hasMany(ProductCompatibility::class);
    }


    public function hasCompatibilitiesWithProduct($product_id)
    {
        $results = $this->product_compatibilities->whereIn('product_id',$product_id);
        if(count($results) > 0) return true;

        return false;

        
    }
}
