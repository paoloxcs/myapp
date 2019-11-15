<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    //
    protected $fillable=['slidename', 'headerline', 'slidetext', 'textlink', 'actionlink', 'url_image', 'status'];
    //public $timestamps=false;
}
