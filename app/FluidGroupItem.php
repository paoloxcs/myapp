<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FluidGroupItem extends Model
{
    protected $table = 'fluid_group_items';
    protected $fillable = ['name','fluid_group_id'];
    public $timestamps = false;

    public function group()
    {
    	return $this->belongsTo(FluidGroup::class,'fluid_group_id');
    }
    public function profile_compatibilities()
    {
    	return $this->hasMany(ProfileFluidCompatibility::class);
    }
}
