<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FluidKey extends Model
{
    protected $table = 'fluid_keys';
    protected $fillable = ['name','sigla'];
    public $timestamps = false;

    public function profile_compatibilities()
    {
    	return $this->hasMany(ProfileFluidCompatibility::class);
    }

}
