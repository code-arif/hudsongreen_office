<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name',
        'principal_name',
        'email',
        'phone',
        'street_address',
        'city',
        'state',
        'zip_code',
        'approximate_student_count',
        'status',
        'approved_by',
        'approved_at',
        'cancelled_by',
        'cancelled_at',
        'approval_token',
        'user_id',
    ];

    //hidden property
    protected $hidden = [
        'updated_at',
        'approval_token'
    ];


    //relation with contact table
    public function contact()
    {
        return $this->hasOne(Contact::class);
    }


    //relation with user table
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
