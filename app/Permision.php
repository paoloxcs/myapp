<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permision extends Model
{
    
    public function rule()
    {
    	return $this->belongsToMany(Rule::class,'rules_permisions','permision_id');
    }
}
