<?php

namespace App;

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
}
