<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Resource
{
    use SoftDeletes;
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
    protected $dates = ['deleted_at'];
}