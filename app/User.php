<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Lunaweb\EmailVerification\Traits\CanVerifyEmail;
use Lunaweb\EmailVerification\Contracts\CanVerifyEmail as CanVerifyEmailContract;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements CanVerifyEmailContract
{
    use Notifiable, CanVerifyEmail;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}