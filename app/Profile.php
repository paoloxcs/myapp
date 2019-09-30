<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['type','slug','summary','body','url_image','status','created_by','category_id'];

    
    // Ralations
    public function category()
    {
    	return $this->belongsTo(Category::class,'category_id');
    }
    public function markets()
    {
    	return $this->belongsToMany(Market::class, 'markets_profiles');
    }
    public function creator()
    {
    	return $this->belongsTo(User::class,'created_by');
    }
    public function parts()
    {
    	return $this->hasMany(ProfilePart::class);
    }
    public function dimensions()
    {
    	return $this->hasMany(DimensionProfile::class);
    }

    public function unit_measurements()
    {
        return $this->hasMany(UnitMeasurement::class);
    }

    // Mutators
    public function getUrlImageAttribute($value)
    {
    	return url('/').'/allimages/'.$value;
    }

}
