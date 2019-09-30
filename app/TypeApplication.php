<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeApplication extends Model
{
    protected $table ='type_applications';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function profile_compatibilities()
    {
    	return $this->hasMany(ProfileFluidCompatibility::class);
    }
}
