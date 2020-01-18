<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimBook extends Model
{
    protected $fillable = [
        'book_number',
        'name',
        'last_name',
        'nrs',
        'phone_number',
        'doc_number',
        'email',
        'address',
        'reason',
        'detail',
        'request_client'
    ];

    
}
