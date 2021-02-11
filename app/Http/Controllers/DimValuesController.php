<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dimensionvalues;
use App\Models\Dimensions;
use App\Models\Batchs;
use App\Models\Products;

class DimValuesController extends Controller
{
    // list all items
    public function list(Request $request, $batch_id, $dim_id){
        $dimvalues = Dimensionvalues::where('dimensions_id','=',$dim_id)->get();
        $dimensions = Dimensions::findOrfail($dim_id);
        $batch = Batchs::findOrfail($batch_id);
        $product = Products::findOrfail($batch->products_id);
        return view('admin.dimvalues.list_view',['dimensionvalues'=>$dimvalues,'dimensions'=>$dimensions,'batch'=>$batch,'product'=>$product]);
    }

    // create
    public function create(Request $request, $batch_id, $dim_id){
        if($request->isMethod('post'))
        {
            $data = $request->input();
            $dimvalues = new Dimensionvalues;
            $dimvalues->dimensions_id = $dim_id;
            $dimvalues->value = $data['value'];
            $dimvalues->save();

            return $dimvalues;
        }
    }

    // update
    public function update(Request $request, $batch_id, $dimvalue_id){
        if($request->isMethod('post'))
        {
            $dimvalues = Dimensionvalues::findOrfail($dimvalue_id);

            $data = $request->input();
            $dimvalues = $dimvalues->update([
                'value'=>$data['value'],
            ]);

            return $dimvalues;
        }
    }

    // delete
    public function delete(Request $request, $batch_id,$dimvalue_id){
        if($request->isMethod('post'))
        {
            $dimvalues = Dimensionvalues::findOrfail($dimvalue_id);

            $dimvalues->delete();

            return response('Record deleted', 200);
        }
    }
}
