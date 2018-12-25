<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'photo_url','name', 'username','email','type','blocked','remember_token','email_verified_at',
=======
        'name', 'username','email','type','blocked','last_shift_start','last_shift_end','shift_active'
>>>>>>> 6a0dc0c35f5aa35c2d3c527ac3f297230fa68613
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
