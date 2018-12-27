<?php
namespace App\Http\Resources;
use Illuminate\Database\Eloquent\Model;

class Meal extends Resource

{
    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'state' => $this->state,
            'table_number' => $this->table_number,
            'start' => $this->start,
            'end' => $this->end,
            'responsible_waiter_id' => $this->responsible_waiter_id,
            'total_price_preview' => $this->total_price_preview
        ];
    }
    public function orders(){
		return $this->hasMany('App\Order','meal_id','id');
    }
    public function user(){
		return $this->belongsTo('App\User','responsible_waiter_id','id');
	}
}