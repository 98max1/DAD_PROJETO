<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

use App\Http\Resources\Table as TableResource;
use Illuminate\Support\Facades\DB;
use App\Table;

use App\StoreItemRequest;
use Hash;

class TableControllerAPI extends Controller
{
    //public function index(Request $request)
    public function index(Request $request)
    {

        return TableResource::collection(Table::get());
    }

    public function store(Request $request)
    {
        $request->validate([
                'table_number' => 'required|integer|unique:restaurant_tables',
            ]);
        $restaurant_table= Table::create(request(['table_number']));
//        $restaurant_table->save();
        return response()->json($restaurant_table, 201);
    }

    public function destroy($id)
    {
    	$table=Table::where('table_number','=',$id)->first();
            if($table->forceDelete()){
                return response()->json(null, 204);
            }
		$table->delete();
		return response()->json(null,401);
    }
}
