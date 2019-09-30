<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','last_name', 'email', 'password','rule_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function fullName()
    {
        return $this->name.' '.$this->last_name;
    }

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }

    public function prfiles()
    {
        return $this->hasMany(Profile::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Verificar si el usuario autenticado tiene acceso al panel
    // retorna verdadero o falso
    public function accessPanel()
    {
        return $this->rule->section === 'panel';
    }
}
