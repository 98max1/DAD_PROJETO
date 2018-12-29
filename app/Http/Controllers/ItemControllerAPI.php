<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

use App\Http\Resources\Item as ItemResource;
use Illuminate\Support\Facades\DB;

use App\Item;
use App\Order;
use App\StoreItemRequest;

class ItemControllerAPI extends Controller
{
	public function index(Request $request)
	{
		if($request->has('page')){
			return ItemResource::collection(Item::paginate(10));
		}else{
			return ItemResource::collection(Item::all());
		}
	}
	public function orderItem(Request $request,$id){
		$order = Order::findOrFail($id);
		return ItemResource::collection( Item::select()
			->where('id','=',$order->id)
			->get());	
		//$orders = $meal->order;
		//return OrderResource::collection($orders);
		//return OrderResource::collection($orders_total[0]);
	}
} 