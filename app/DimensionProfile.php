<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DimensionProfile extends Model
{
    protected $table ='dimensions_profiles';
    protected $fillable = ['dimension_id','profile_id'];
    public $timestamps = false;

    public function profile_parts()
    {
    	return $this->belongsToMany(ProfilePart::class,'details_profiles_parts')->withPivot('value_field');
    }

    public function profile()
    {
    	return $this->belongsTo(Profile::class,'profile_id');
    }
    public function dimension()
    {
    	return $this->belongsTo(Dimension::class,'dimension_id');
    }
}
