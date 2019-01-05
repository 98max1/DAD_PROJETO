<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Invoice_item extends Model
{
	protected $fillable = [
        'invoice_id', 'item_id','quantity','unit_price','sub_total_price'
	];

	public $timestamps = false;
}