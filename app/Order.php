<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','state', 'item_id','meal_id','responsible_cook_id','start','end'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function meal(){
        return $this->belongsTo('App\Meal','meal_id','id');
    }
    public function item(){
        return $this->belongsTo('App\Item','item_id','id');
    }
}
