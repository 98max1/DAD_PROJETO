<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

use App\Http\Resources\Meal as MealResource;
use Illuminate\Support\Facades\DB;

use App\Meal;
use App\Order;
use App\Invoice;
use App\Invoice_item;
use App\Item;
use App\StoreItemRequest;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class MealControllerAPI extends Controller
{
	public function index(Request $request)
	{
		/*if($request->has('page')){
			return MealResource::collection(Meal::paginate(10));
		}else{
			return MealResource::collection(Meal::all());
		}*/

		$user =  \Auth::guard('api')->user();

		return MealResource::collection(Meal::select()
			->where('state','=','active')
			->where('responsible_waiter_id','=',$user->id)
			->get());	

	}

	public function mealActive(Request $request){

		/*$meal_check = Meal::select()
						->where('state','=','active')
						->where('responsible_waiter_id','=',\Auth::guard('api')->user()->id)
						->get(); */
		return MealResource::collection( Meal::select()
			->where('state','=','active')
			->where('responsible_waiter_id','=',$user->id)
			->get());	
	}

	public function terminateMeal(Request $request,$id){

		$meal = Meal::findOrFail($id);
        $meal->state = 'terminated';
        //$user->last_shift_Start = new Datetime();
		$invoice = new Invoice();
		$invoice->meal_id = $meal->id;
		$invoice->state = 'pending';
		$invoice->date = date('Y-m-d H:i:s');
		$invoice->total_price = $meal->total_price_preview;
		$invoice->save();
		$orders = Order::select()
			->where('meal_id','=',$id)
			->get();
		foreach($orders as $order){
			if($order != 'delivered'){
				$orderr=Order::findOrFail($order->id);
				$orderr->state = 'not delivered';
				$orderr->save();
			}
			$itemForPrice = Item::findOrFail($orderr->item_id);
			$invoice_item = Invoice_item::select()
					->where('item_id',$itemForPrice->id)
					->where('invoice_id',$invoice->id)
					->get();
			//return $invoice_item;
			$orderr=Order::findOrFail($order->id);
			if($invoice_item->count() == 0){
				$invoice_item = new Invoice_item();
				$invoice_item->invoice_id = $invoice->id;
				$invoice_item->item_id = $orderr->item_id;
				$invoice_item->quantity = 1;
				$invoice_item->unit_price = $itemForPrice->price;
				$invoice_item->sub_total_price = $itemForPrice->price;
				$invoice_item->save();
			}else{
				$invoice_item = Invoice_item::where('item_id', '=', $itemForPrice->id)->where('invoice_id', '=', $invoice->id)->firstOrFail();
				DB::table('invoice_items')
					->where('invoice_id', $invoice->id)
					->where('item_id', $orderr->item_id)
					->update(['quantity' => $invoice_item->quantity + 1,'sub_total_price' => $invoice_item->sub_total_price + $itemForPrice->price]);
			}
			
		}
		$meal->save();
		return response()->json($meal,200);
	}

	

	public function store(Request $request)
    {
		try{
			$request->validate([
					'table_number' => 'required',
					'total_price_preview' => 'required'
				]);
			$meal = new Meal();
			$meal->fill($request->all());
			$meal->start = date('Y-m-d H:i:s');
			
			$meal->responsible_waiter_id = \Auth::guard('api')->user()->id;
			$meal_check = Meal::select()
						->where('table_number','=',$meal->table_number)
						->where('state','=','active')
						->get(); 

			if(!$meal_check->isEmpty())
				throw new \Exception("Number of table have to be unique!");

			$meal->save();
			return response()->json($meal,200);
		}catch(\Exception $error){
			$error= $error->getMessage();
			return response()->json($error,404);
		}

		//$meal->save();
        //return response()->json($user, 201);
	}

	public function dashInfo(Request $request)
	{
		return MealResource::collection(Meal::select()->where('state','=','active')->orWhere('state','=','terminated')->get());
	}
	public function dashInfoAll(Request $request)
	{
		return MealResource::collection(Meal::select()->get());
	}

	public function mealNotPaid(Request $request,$id){

		$meal = Meal::findOrFail($id);
		if ($meal->state=='terminated') {
	        $meal->state = 'not paid';
			$invoice = Invoice::select()->where('meal_id','=',$id);
			if ($invoice->state=='pending') {
				$invoice->state='not paid';			
				
				$orders = Order::select()
					->where('meal_id','=',$id)
					->get();
				foreach($orders as $order){
					if($order != 'delivered'){
						$orderr=Order::findOrFail($order->id);
						$orderr->state = 'not delivered';
						$orderr->save();
					}
				}
			}
		}
		$meal->save();
		$invoice->save();
		return response()->json($meal,200);
	}
	
}