<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    public $timestamps = false;
    /*=========== Relaciones ==================*/
    public function users()
    {
    	return $this->hasMany(User::class);
    }
    public function permissions()
    {
    	return $this->belongsToMany(Permission::class,'role_permission','role_id');
    }

    public function hasPermission($permission)
    {
    	if ($this->permissions()->where('slug',$permission)->first()) return true;

    	return false;
    }
}
