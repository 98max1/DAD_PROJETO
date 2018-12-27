<?php

namespace App\Http\Resources;
use App\Meal;
use App\Order;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Database\Eloquent\Model;


class User extends Resource

{
    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'photo_url' => $this->photo_url,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'type' => $this->type,
            'blocked' => $this->blocked,
            'shift_active' => $this->shift_active,
            'last_shift_start' => $this->last_shift_start,
            'last_shift_end' => $this->last_shift_end
        ];
    }
    public function meals(){
		return $this->hasMany('App\Meal','responsible_waiter_id','id');
    }
}