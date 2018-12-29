<?php

namespace App;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','state', 'table_number','start','end','responsible_waiter_id','total_price_preview'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function orders(){
		  return $this->hasMany('App\Order','meal_id','id');
    }
    public function user(){
      return $this->belongsTo('App\User','id','responsible_waiter_id');
	}
}
