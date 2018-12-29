<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\Resource;


class Order extends Resource

{
    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'state' => $this->state,
            'item_id' => $this->item_id,
            'meal_id' => $this->meal_id,
            'responsible_cook_id' => $this->responsible_cook_id,
            'start' => $this->start,
            'end' => $this->end
        ];
    }
}