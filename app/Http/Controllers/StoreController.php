<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models;

class StoreController extends Controller
{
    public function store(){
        $products = DB::table('products')->join('productimages','products.id','=','productimages.products_id')->get();

        return view('store.store_view', ['products'=>$products]);
    }
}
