<?php

namespace App\Http\Resources;
use App\Meal;
use App\User;
use App\Order;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Database\Eloquent\Model;

class Item extends Resource

{
    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'photo_url' => $this->photo_url,
            'price' => $this->price
        ];
    }
}
