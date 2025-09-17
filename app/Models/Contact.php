<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'school_id',
        'name',
        'email',
        'phone',
        'role',
    ];

    // hidden property
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
