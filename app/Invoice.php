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
        'id','state', 'meal_id','nif','name','date','total_price'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
