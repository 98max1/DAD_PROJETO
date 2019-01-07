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
} 