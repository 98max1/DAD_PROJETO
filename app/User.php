<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $fillable = [
        'id','photo_url','name', 'username','email','type','blocked','remember_token','email_verified_at',  'last_shift_start','last_shift_end','shift_active'
      
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}