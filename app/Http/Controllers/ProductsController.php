<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Prices;
use App\Models\Productpriceview;

class ProductsController extends Controller
{
    // list all items
    public function list(Request $request){
        $products = Products::paginate(15);
        return view('admin.products.list_view', ['products'=>$products]);
    }

    // create view
    public function create(Request $request){
        if($request->isMethod('post'))
        {
            $data = $request->input();

            info($data);

            return $data;
        }

        return view('admin.products.create_view');
    }

    // update view
    public function update(Request $request, $id){
        if($request->isMethod('post'))
        {
            $data = $request->input();

            info($data);

            return $data;
        }
        $product = Products::findOrfail($id);
        $batchs = BatchsController::batchs($id);
        return view('admin.products.update_view', ['product'=>$product,'batchs'=>$batchs]);
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
