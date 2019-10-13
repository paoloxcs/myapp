<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iso extends Model
{
    protected $fillable = ['name','description'];

    public $timestamps = false;

    // Relacion con partes
    public function parts()
    {
        return $this->belongsToMany(ProductPart::class,'iso_part','iso_id','part_id');
    }
}
