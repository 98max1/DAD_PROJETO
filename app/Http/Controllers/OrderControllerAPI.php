<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

use App\Http\Resources\Order as OrderResource;
use Illuminate\Support\Facades\DB;

use App\Order;
use App\User;
use App\StoreItemRequest;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderControllerAPI extends Controller
{
	public function index(Request $request)
	{
		if($request->has('page')){
			return OrderResource::collection(Order::paginate(10));
		}else{
			return OrderResource::collection(Order::all());
		}
	}

	public function ordersWaiter(Request $request)
	{
		$user =  \Auth::guard('api')->user();
		$meals = $user->meals;
		$orders_total = null;
		foreach($meals as $meal){
			if(!strcmp($meal->state, 'active')) 
				$orders_total[] = $meal->orders;
		}
		
		return OrderResource::collection($orders_total[0]);
	}

	public function store(Request $request)
    {
	//return response()->json($request,200);
	$request->validate([
			'item_id' => 'required',//|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
			'meal_id' => 'required',
		]);
	$order = new Order();
	$order->fill($request->all());
	$order->start = date('Y-m-d H:i:s');
	$order->save();
	return response()->json($order,200);
	}
}