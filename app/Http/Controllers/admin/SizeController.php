<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $data = size::all();
        return view('admin/size', compact('data'));
    }
    public function manage_size(Request $request, $id='')
    {
        if($id>0)
        {
            $arr = size::where(['id'=>$id])->get();

            $result['size']= $arr['0']->size;
            $result['status']= $arr['0']->status;
            $result['id']= $arr['0']->id;
        }else{
            $result['size']= '';
            $result['status']= '';
            $result['id']= '';
        }


        return view('admin/manageSize/manageSize', $result);
    }
    public function sizeInsert(Request $request)
    {
        $request->validate([
            'size' => 'required|unique:sizes,size,'.$request->post('id'),

        ]);
        if($request->post('id')>0)
        {
            $model =size::find($request->post('id'));
            $msg = "size Updated";

        }else{
            $model = new size();
            $msg = "size Inserted";


        }
        $model->size = $request->post('size');
        $model->status = 1;

        $model->save();
        return redirect('admin/size')->with("message", $msg);
    }

    public function delete($id){
        $model = size::where('id',$id)->first();
        $model->delete();
        return redirect('admin/size')->with("message", "size deleted Successfully");
    }

    // public function sizeEdit($id)
    // {
    //     $model = size::where('id',$id)->first();
    //     return view('admin/managSize/edit_size', compact('model'));
    // }
    public function status(Request $request,$status , $id){
        $model = size::where('id',$id)->first();
        $model->status=$status;
        $model->save();
        return redirect('admin/size')->with("message", "size status Updated Successfully");

    }
}
