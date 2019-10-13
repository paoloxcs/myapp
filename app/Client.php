<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['phone_number','address','user_id'];

    // Relacion con usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
