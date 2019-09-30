<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileFluidCompatibility extends Model
{
    protected $table = 'profile_fluid_compatibilities';
    protected $fillable = ['profile_id','type_application_id','fluid_group_item_id','fluid_key_id'];

    public $timestamps = false;

    public function profile()
    {
    	return $this->belongsTo(Profile::class,'profile_id');
    }
    public function type_application()
    {
    	return $this->belongsTo(TypeApplication::class,'type_application_id');
    }
    public function group_item()
    {
    	return $this->belongsTo(FluidGroupItem::class,'fluid_group_item_id');
    }
    public function fluid_key()
    {
    	return $this->belongsTo(FluidKey::class,'fluid_key_id');
    }
}
