<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $data = tax::all();
        return view('admin/tax', compact('data'));
    }
    public function manage_tax(Request $request, $id='')
    {
        if($id>0)
        {
            $arr = tax::where(['id'=>$id])->get();

            $result['tax_desc']= $arr['0']->tax_desc;
            $result['tax_value']= $arr['0']->tax_value;
            $result['id']= $arr['0']->id;
        }else{
            $result['tax_desc']= '';
            $result['tax_value']= '';
            $result['status']= '';
            $result['id']= '';
        }


        return view('admin/manageTax/manageTax', $result);
    }
    public function taxInsert(Request $request)
    {
        $request->validate([
            'tax_value' => 'required|unique:taxes,tax_value,'.$request->post('id'),

        ]);
        if($request->post('id')>0)
        {
            $model =tax::find($request->post('id'));
            $msg = "tax Updated";

        }else{
            $model = new tax();
            $msg = "tax Inserted";


        }
        $model->tax_value = $request->post('tax_value');
        $model->tax_desc = $request->post('tax_desc');
        $model->status = 1;

        $model->save();
        return redirect('admin/tax')->with("message", $msg);
    }

    public function delete($id){
        $model = tax::where('id',$id)->first();
        $model->delete();
        return redirect('admin/tax')->with("message", "tax deleted Successfully");
    }
    public function status(Request $request,$status , $id){
        $model = tax::where('id',$id)->first();
        $model->status=$status;
        $model->save();
        return redirect('admin/tax')->with("message", "tax status Updated Successfully");

    }
}
