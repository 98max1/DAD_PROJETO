<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

use App\Http\Resources\Meal as MealResource;
use Illuminate\Support\Facades\DB;

use App\Meal;
use App\StoreItemRequest;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class MealControllerAPI extends Controller
{
	public function index(Request $request)
	{
		if($request->has('page')){
			return MealResource::collection(Meal::paginate(10));
		}else{
			return MealResource::collection(Meal::all());
		}
	}
	public function mealActive(Request $request){

		/*$meal_check = Meal::select()
						->where('state','=','active')
						->where('responsible_waiter_id','=',\Auth::guard('api')->user()->id)
						->get(); */
		return MealResource::collection( Meal::select()
			->where('state','=','active')
			->where('responsible_waiter_id','=',\Auth::guard('api')->user()->id)
			->get());	
	}

	public function store(Request $request)
    {
		try{
			error_log('Some message here.');
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
}