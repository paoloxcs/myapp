<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePart extends Model
{
    protected $table = 'profiles_parts';
    protected $fillable = ['part_nro','profile_id','url_pdf','unit_measurement_id'];

    public $timestamps = false;

    public function profile()
    {
    	return $this->belongsTo(Profile::class,'profile_id');
    }
    public function dimensions_profile()
    {
    	return $this->belongsToMany(DimensionProfile::class,'details_profiles_parts')->withPivot('value_field');
    }

    public function unit_measurement()
    {
        return $this->belongsTo(UnitMeasurement::class, 'unit_measurement_id');
    }

}
