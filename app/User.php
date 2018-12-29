<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable,SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','photo_url','name', 'username','email','type','blocked','remember_token','email_verified_at',  'last_shift_start','last_shift_end','shift_active'
      
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $dates = ['deleted_at'];
    
    public function meals(){
        return $this->hasMany('App\Meal','responsible_waiter_id');
    }    
    public function isManager(){
        if ($this->type=='manager') {
            return true;
        }
        return false;
    }
}
