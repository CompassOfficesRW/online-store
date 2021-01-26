<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class OrdersController extends Controller
{
    // create view
    public function create(Request $request)
    {
        $customers = Customers::all();

        return view('orders.create_view', ['customers' => $customers]);
    }
}
