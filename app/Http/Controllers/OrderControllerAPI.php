<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

use App\Http\Resources\Order as OrderResource;
use Illuminate\Support\Facades\DB;

use App\Order;
use App\User;
use App\Item;
use App\Meal;
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
		$order = Order::whereHas('meal', function($query) use ($user){
			$query->where('responsible_waiter_id', $user->id)
					->where('state', 'active');
		})->get();
		return OrderResource::collection($order);
	}

	public function ordersFromMeal(Request $request,$id){
		$meal = Meal::findOrFail($id);
		return OrderResource::collection( Order::select()
			->where('meal_id','=',$meal->id)
			->get());	
		//$orders = $meal->order;
		//return OrderResource::collection($orders);
		//return OrderResource::collection($orders_total[0]);
	}

	public function orderDelete($id)
    {
        try{
			$order = Order::findOrFail($id);
			$timeNow = strtotime(date('Y-m-d H:i:s'));
			$timestart = strtotime($order->start);
			if(($timeNow - $timestart) > 5)
				throw new \Exception("Ja passou mais de 5 segundos");
		
			$order->delete();
			return response()->json(null, 204);
		}catch(\Exception $error){
			$error= $error->getMessage();
			return response()->json($error,404);
		}
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
	$mealId = $order->meal->id;
	$meal = Meal::findOrFail($mealId);
	$item = $order->item;
	$itemPrice = $item->price;

	$meal->total_price_preview = $meal->total_price_preview + $itemPrice;
	$meal->save();
	
	return response()->json($order,200);
	}

	public function orderDeliver(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->state = 'delivered';
        //$user->last_shift_Start = new Datetime();
        $order->save();
        return response()->json($order,200);
    }
}