<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    // list all customers
    public function list(){
        $customers = Customers::paginate(15);
        return view('admin.customers.list_view', ['customers'=> $customers]);
    }

    public function validation($request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mediatype' => 'required',
        ]);

        $validator->sometimes('mediaid', 'required', function($input){
            return $input->mediatype != \App\Enums\CustMediaType::Whatsapp;
        });

        $validator->sometimes('mobile', 'required|regex:/[0-9]{7}/', function($input){
            return $input->mediatype == \App\Enums\CustMediaType::Whatsapp;
        });

        return $validator;
    }

    // create view
    public function create(Request $request){
        if($request->isMethod('post'))
        {
            // $validator = Validator::make($request->all(), [
            //     'name' => 'required',
            //     'mediatype' => 'required',
            // ]);
            //
            // $validator->sometimes('mediaid', 'required', function($input){
            //     return $input->mediatype != \App\Enums\CustMediaType::Whatsapp;
            // });
            //
            // $validator->sometimes('mobile', 'required|regex:/[0-9]{7}/', function($input){
            //     return $input->mediatype == \App\Enums\CustMediaType::Whatsapp;
            // });
            $validator = $this->validation($request);

            if($validator->fails()){
                //return view('admin.customers.create_view', ['mediatypes'=>\App\Enums\CustMediaType::asArray(),])->withErrors($validator);
                return redirect()->back()->withInput()->withErrors($validator);
            }
            // $data = $request->validate([
            //     'name' => 'required',
            //     'mediatype' => 'required',
            // ]);
            $data = $request->input();
            $customer = tap(new \App\Models\Customers($data))->save();

            //return view('admin.customers.list_view', ['customers'=>Customers::paginate(15),]);
            return redirect('/customers');
        }

        return view('admin.customers.create_view', ['mediatypes'=>\App\Enums\CustMediaType::asArray(),]);
    }

    // edit view
    public function edit(Request $request, $id){
        if($request->isMethod('post'))
        {
            $validator = $this->validation($request);
            if($validator->fails()){
                return redirect()->back()->withInput()->withErrors($validator);
            }

            return redirect('/customers');
        }
        $customer = Customers::findOrFail($id);

        return view('admin.customers.edit_view', ['mediatypes'=>\App\Enums\CustMediaType::asArray(),'customer'=>$customer]);
    }

    // delete view
    public function delete(Request $request, $id){
        if($request->isMethod('post'))
        {
            $customer = Customers::findOrFail($id);
            $customer->delete();
            return redirect('/customers');
        }
        $customer = Customers::findOrFail($id);
        return view('admin.customers.delete_view', ['customer'=>$customer]);
    }
}
