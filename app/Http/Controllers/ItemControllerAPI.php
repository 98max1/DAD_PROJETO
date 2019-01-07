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
        return ItemResource::collection(Item::withTrashed()->orderBy('id',"asc")->paginate(5));
		if($request->has('pagination')){
			return ItemResource::collection(Item::paginate(10));
		}else{
			return ItemResource::collection(Item::all());
		}
	}

    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required|min:3',//|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
                'username' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3',
                'type' => 'required|min:3',
                'blocked' => 'required|integer|between:0,1'
            ]);
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($user->password);
        $user->save();
        \Mail::to($user)->send(new Welcome);
        return response()->json($user, 201);
	}
	public function orderItem(Request $request,$id){
        $order = Order::findOrFail($id);
        $item= Item::select()
        ->where('id','=',$order->id)
        ->get();
        return $item->id;
		return ItemResource::collection( Item::select()
			->where('id','=',$id)
			->get());	
		//$orders = $meal->order;
		//return OrderResource::collection($orders);
		//return OrderResource::collection($orders_total[0]);
    }
    public function itemsAll(Request $request){
		return ItemResource::collection(Item::all());
		//$orders = $meal->order;
		//return OrderResource::collection($orders);
		//return OrderResource::collection($orders_total[0]);
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
                'name' => 'nullable|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
                'description' => 'nullable|min:2',
                'price' => 'nullable|numeric',
                'type' => 'nullable'
            ]);
        $item = Item::findOrFail($id);
        if (!is_null($request->name)) {
            $item->name=$request->name;
        }
        if (!is_null($request->description)) {
            $item->description=$request->description;
        }
        if (!is_null($request->type)) {
            if ($request->type=="dish" ||$request->type=="drink") {
                $item->type=$request->type;
            }
        }
        if (!is_null($request->price)) {
            $item->price=$request->price;
        }
        $item->save();
        return response()->json($item,201);
    }
} 