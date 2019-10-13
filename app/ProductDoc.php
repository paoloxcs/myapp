<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDoc extends Model
{
    protected $table = 'product_docs';
    protected $fillable = ['name','url_doc','product_id'];
    public $timestamps = false;

    // Relacion con producto
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
