<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models;

class StoreController extends Controller
{
    public function store(){
        $products = DB::table('products');
        $products_images = $products->join('productimages','products.id','=','productimages.products_id');
        $batchs = $products->join('batchs','products.id','=','batchs.products_id');

        return view('store.store_view',
            [
                'products'=>$products->get(),
                'products_images'=>$products_images->get(),
                'batchs'=>$batchs->select('batchs.name as batch_name','products.name as product_name','products.description')->get()
            ]
        );
    }
}
