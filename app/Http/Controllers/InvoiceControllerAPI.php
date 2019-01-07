<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

use App\Http\Resources\Invoice as InvoiceResource;
use Illuminate\Support\Facades\DB;

use App\Invoice;

class InvoiceControllerAPI extends Controller
{
    public function dashInvoices(Request $request)
    {
        return InvoiceResource::collection(Invoice::select()->where('state','=','pending')->get());
    }

    public function dashInvoicesAll(Request $request)
    {
        return InvoiceResource::collection(Invoice::all());
    }

    public function invoiceNotPaid(Request $request,$id){

        $invoice = Invoice::findOrFail($id);
        $meal = Meal::findOrFail($invoice->meal_id);
            $meal->state = 'not paid';
            $invoice->state='not paid';         
            $orders = Order::select()
                ->where('meal_id','=',$meal->id)
                ->get();
            foreach($orders as $order){
                if($order != 'delivered'){
                    $orderr=Order::findOrFail($order->id);
                    $orderr->state = 'not delivered';
                    $orderr->save();
                }
            }
        }
        $meal->save();
        $invoice->save();
        return response()->json($invoice,204);
    }
} 