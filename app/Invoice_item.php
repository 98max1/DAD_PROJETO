<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice_item extends Model
{
	use SoftDeletes;
	protected $fillable = [
        'invoice_id', 'item_id','quantity','unit_price','sub_total_price'
	];
	public $timestamps = false;
}