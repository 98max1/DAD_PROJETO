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
} 