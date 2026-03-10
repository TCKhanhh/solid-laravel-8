<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; // tạm comment
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable //implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'status',
        'failed_login_attempts',
        'account_locked_until',
        'last_login_at',
        'last_login_ip',
        'remember_token',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'account_locked_until' => 'datetime',
        'last_login_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    protected $attributes = [
        'status' => 'active',
        'failed_login_attempts' => 0,
    ];
}