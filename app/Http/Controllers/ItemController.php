<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    public function index(Request $request){

    	$menu = Item::all();

    	return view('vue.index', compact('menu'));
    }
}
