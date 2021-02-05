<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prices;
use App\Models\Batchs;
use App\Models\Products;

class PricesController extends Controller
{
    // list all items
    public function list(Request $request, $batch_id){
        $prices = Prices::where('Batchs_id',"=",$batch_id)->get();
        $batch = Batchs::findOrfail($batch_id);
        $product = Products::findOrfail($batch->products_id);
        return view('admin.prices.list_view',['prices'=>$prices,'batch'=>$batch,'product'=>$product]);
    }

    // create
    public function create(Request $request, $batch_id){
        if($request->isMethod('post'))
        {
            // $request->validate([
            //     'fromqty' => 'required|not_in:0',
            //     'toqty' => 'required|not_in:0',
            //     'salesprice' => 'required|not_in:0',
            // ]);

            $data = $request->input();
            $prices = new Prices;
            $prices->Batchs_id = $batch_id;
            $prices->fromqty = $data['fromqty'];
            $prices->toqty = $data['toqty'];
            $prices->salesprice = $data['salesprice'];
            $prices->save();

            return $prices;
        }
    }

    // update
    public function update(Request $request, $price_id){
        if($request->isMethod('post'))
        {
            $prices = Prices::findOrfail($price_id);

            $data = $request->input();
            $prices = $prices->update([
                'fromqty'=>$data['fromqty'],
                'toqty'=>$data['toqty'],
                'salesprice'=>$data['salesprice']
            ]);

            return $prices;
        }
    }
}
