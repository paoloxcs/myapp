<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    
    public function role()
    {
    	return $this->belongsToMany(Role::class,'rule_permission','permission_id');
    }
}
