<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    protected $fillable = ['name','sigla'];
    public $timestamps = false;

    public function profiles()
    {
    	return $this->hasMany(DimensionProfile::class);
    }
}
