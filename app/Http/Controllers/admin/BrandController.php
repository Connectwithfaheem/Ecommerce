<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $data = brand::all();
        return view('admin/brand', compact('data'));
    }
    public function manage_brand(Request $request, $id='')
    {
        if($id>0)
        {
            $arr = brand::where(['id'=>$id])->get();

            $result['brand']= $arr['0']->brand;
            $result['image']= $arr['0']->image;
            $result['status']= $arr['0']->status;
            $result['id']= $arr['0']->id;
        }else{
            $result['brand']= '';
            $result['image']= '';
            $result['status']= '';
            $result['id']= '';
        }


        return view('admin/manageBrand/manageBrand', $result);
    }
    public function brandInsert(Request $request)
    {


        $request->validate([
            'brand' => 'required|unique:brands,brand,'.$request->post('id'),
            'image' => "mimes:png,jpg,jpeg",

        ]);

        if($request->post('id')>0)
        {
            $model =brand::find($request->post('id'));
            $msg = "brand Updated";

        }else{
            $model = new brand();
            $msg = "brand Inserted";
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $product_image_name = time() . '.' . $ext; // Use a different variable name for product image
            $image->move(public_path('brandImage'), $product_image_name);
            $model->image = $product_image_name; // Assign the product image name to model image
        }
        $model->brand = $request->post('brand');
        $model->status = 1;

        $model->save();
        return redirect('admin/brand')->with("message", $msg);
    }

    public function delete($id){
        $model = brand::where('id',$id)->first();
        $model->delete();
        return redirect('admin/brand')->with("message", "brand deleted Successfully");
    }

    // public function brandEdit($id)
    // {
    //     $model = brand::where('id',$id)->first();
    //     return view('admin/managbrand/edit_brand', compact('model'));
    // }
    public function status(Request $request,$status , $id){
        $model = brand::where('id',$id)->first();
        $model->status=$status;
        $model->save();
        return redirect('admin/brand')->with("message", "brand status Updated Successfully");

    }
}
