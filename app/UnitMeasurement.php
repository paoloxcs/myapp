<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitMeasurement extends Model
{
    protected $table = 'unit_measurements';
    protected $fillable = ['name','enabled','profile_id'];

    public $timestamps = false;

    public function profile()
    {
        return $this->belongsTo(Profile::class,'profile_id');
    }
    public function profile_parts()
    {
        return $this->hasMany(ProfilePart::class);
    }


}
