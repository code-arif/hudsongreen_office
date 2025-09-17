<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, Billable;

    // fillable
    protected $fillable = [
        'school_id',
        'username',
        'password',
        'role',
        'email',
        'avatar',
        'otp',
        'is_otp_verified',
        'otp_expires_at',
        'reset_password_token',
        'reset_password_token_expire_at',
        'email_verified_at',
        'is_email_verified',
        'verification_token'
    ];


    // casting
    protected $casts = [
        'is_otp_verified' => 'boolean',
        'otp_expires_at' => 'datetime',
        'reset_password_token_expire_at' => 'datetime',
    ];

    // hidden property
    protected $hidden = [
        'created_at',
        'updated_at',
        'password',
        'verification_token',
        'email_verified_at',
        'is_email_verified'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    //relation with school table
    public function school()
    {
        return $this->hasOne(School::class);
    }
}
