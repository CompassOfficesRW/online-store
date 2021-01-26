<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Prices;
use App\Models\Productpriceview;

class ProductsController extends Controller
{
    // create view
    public function create(Request $request){
        if($request->isMethod('post'))
        {
            $data = $request->input();

            return $data;
        }
        return view('admin.products.create_view');
    }

    // get pricing
    public function product_price(Request $request, $product_id, $batch_id, $qty){
        $productprice = Productpriceview::where(
            [
                ['product_id','=',$product_id],
                ['batch_id','=',$batch_id],
                ['price_fromqty','<=',$qty],
                ['price_toqty','>=',$qty],
                ['batch_active','=','1'],
            ]
        )->get();
        if($productprice->isEmpty()){
            abort(404);
        }
        return $productprice;
    }

    // save dimension
    public function save_dimension(Request $request){

    }
}
