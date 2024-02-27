<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data = customer::all();
        return view('admin/customer', compact('data'));
    }
    public function show(Request $request, $id='')
    {
        $arr = customer::where(['id'=>$id])->get();
        $result['customerList']= $arr['0'];

        return view('admin/showCustomer/showCustomer', $result);
    }


    public function status(Request $request,$status , $id){
        $model = customer::where('id',$id)->first();
        $model->status=$status;
        $model->save();
        return redirect('admin/customer')->with("message", "Customer status Updated Successfully");

    }

}
