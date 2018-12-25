<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

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
            'shift_status' => $this->shift_status
        ];
    }
}