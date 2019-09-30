<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    
    /*=========== Relaciones ==================*/
    public function users()
    {
    	return $this->hasMany(User::class);
    }
    public function permisions()
    {
    	return $this->belongsToMany(Permision::class,'rules_permisions','rule_id');
    }

    public function hasPermision($permision)
    {
    	if ($this->permisions()->where('slug',$permision)->first()) return true;

    	return false;
    }
}
