<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $data = color::all();
        return view('admin/color', compact('data'));
    }
    public function manage_color(Request $request, $id='')
    {
        if($id>0)
        {
            $arr = color::where(['id'=>$id])->get();

            $result['color']= $arr['0']->color;
            $result['status']= $arr['0']->status;
            $result['id']= $arr['0']->id;
        }else{
            $result['color']= '';
            $result['status']= '';
            $result['id']= '';
        }


        return view('admin/manageColor/manageColor', $result);
    }
    public function colorInsert(Request $request)
    {
        $request->validate([
            'color' => 'required|unique:colors,color,'.$request->post('id'),

        ]);
        if($request->post('id')>0)
        {
            $model =color::find($request->post('id'));
            $msg = "color Updated";

        }else{
            $model = new color();
            $msg = "color Inserted";


        }
        $model->color = $request->post('color');
        $model->status = 1;

        $model->save();
        return redirect('admin/color')->with("message", $msg);
    }

    public function delete($id){
        $model = color::where('id',$id)->first();
        $model->delete();
        return redirect('admin/color')->with("message", "color deleted Successfully");
    }

    public function status(Request $request,$status , $id){
        $model = color::where('id',$id)->first();
        $model->status=$status;
        $model->save();
        return redirect('admin/color')->with("message", "color status Updated Successfully");

    }
}
