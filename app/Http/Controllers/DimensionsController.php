<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dimensions;
use App\Models\Batchs;
use App\Models\Products;

class DimensionsController extends Controller
{
    // list all items
    public function list(Request $request, $batch_id){
        $dimensions = Dimensions::where('Batchs_id',"=",$batch_id)->get();
        $batch = Batchs::findOrfail($batch_id);
        $product = Products::findOrfail($batch->products_id);
        return view('admin.dimensions.list_view',['dimensions'=>$dimensions,'batch'=>$batch,'product'=>$product]);
    }

    // create
    public function create(Request $request, $batch_id){
        if($request->isMethod('post'))
        {
            $data = $request->input();
            $dimensions = new Dimensions;
            $dimensions->Batchs_id = $batch_id;
            $dimensions->name = $data['name'];
            $dimensions->save();

            return $dimensions;
        }
    }

    // update
    public function update(Request $request, $dim_id){
        if($request->isMethod('post'))
        {
            $dimensions = Dimensions::findOrfail($dim_id);

            $data = $request->input();
            $dimensions = $dimensions->update([
                'name'=>$data['name'],
            ]);

            return $dimensions;
        }
    }

    // delete
    public function delete(Request $request, $dim_id){
        if($request->isMethod('post'))
        {
            $dimensions = Dimensions::findOrfail($dim_id);

            $dimensions->delete();

            return response('Record deleted', 200);
        }
    }
}
