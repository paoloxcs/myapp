<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FluidGroup extends Model
{
    protected $table = 'fluid_groups';
    protected $fillable = ['name'];

    public $timestamps = false;

    public function items()
    {
    	return $this->hasMany(FluidGroupItem::class);
    }
}
