<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batchs;

class BatchsController extends Controller
{
    // get batchs from product ID
    public static function batchs($product_id){
        $batchs = Batchs::where('products_id', '=', $product_id)->paginate(10);
        return $batchs;
    }

    // list all items
    public function list(Request $request, $product_id){
        $batchs = $this::batchs($product_id);
        return $response()->json($batchs);
    }

    // create
    public function create(Request $request, $product_id){
        if($request->isMethod('post'))
        {
            $data = $request->input();
            $batchs = new Batchs;
            $batchs->products_id = $product_id;
            $batchs->name = $data['name'];
            $batchs->save();

            return $batchs;
        }
    }

    // update
    public function update(Request $request, $batch_id){
        if($request->isMethod('post'))
        {
            $batchs = Batchs::findOrfail($batch_id);

            $data = $request->input();
            $batchs = $batchs->update(['name'=>$data['name']]);

            return $batchs;
        }
    }
}
