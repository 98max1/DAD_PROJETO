<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

use App\Http\Resources\Meal as MealResource;
use Illuminate\Support\Facades\DB;

use App\Meal;
use App\StoreItemRequest;

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
	public function store(Request $request)
    {
        $request->validate([
                'table_number' => 'required',
                'total_price_preview' => 'required'
            ]);
        $meal = new User();
        $meal->fill($request->all());
		

		$meal = Meal::where('table_number',$user->table_number);
		if($meal != null)
			return response()->json(['error' => 'Number of table have to be unique!'],404);

		//$meal->save();
        //return response()->json($user, 201);
    }

} 

