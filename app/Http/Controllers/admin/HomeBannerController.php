<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomeBanner;
use Illuminate\Http\Request;

class HomeBannerController extends Controller
{
    public function index()
    {
        $data = HomeBanner::all();
        return view('admin/HomeBanner', compact('data'));
    }
    public function manage_HomeBanner(Request $request, $id='')
    {
        if($id>0)
        {
            $arr = HomeBanner::where(['id'=>$id])->get();

            $result['image']= $arr['0']->image;
            $result['btn_text']= $arr['0']->btn_text;
            $result['btn_link']= $arr['0']->btn_link;
            $result['id']= $arr['0']->id;


        }else{
            $result['image']= '';
            $result['btn_text']= '';
            $result['btn_link']= '';
            $result['id']= '';

        }


        return view('admin/manageHomeBanner/manageHomeBanner', $result);
    }
    public function HomeBannerInsert(Request $request)
    {
        $request->validate([
            'image' => 'mimes:png,jpg,jpeg', // Add validation rule for attribute image


        ]);

        if($request->post('id')>0)
        {
            $model =HomeBanner::find($request->post('id'));
            $msg = "Banner Updated";

        }else{
            $model = new HomeBanner();
            $msg = "Banner Inserted";
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $product_image_name = time() . '.' . $ext; // Use a different variable name for product image
            $image->move(public_path('HomeBannerImage'), $product_image_name);
            $model->image = $product_image_name; // Assign the product image name to model image
        }
        $model->btn_text = $request->post('btn_text');
        $model->btn_link = $request->post('btn_link');
        $model->status = 1;

        $model->save();
        return redirect('admin/HomeBanner')->with("message", $msg);
    }

    public function delete($id){
        $model = HomeBanner::where('id',$id)->first();
        $model->delete();
        return redirect('admin/HomeBanner')->with("message", "HomeBanner deleted Successfully");
    }

    public function HomeBannerEdit($id)
    {
        $model = HomeBanner::where('id',$id)->first();
        return view('admin/manageHomeBanner/edit_HomeBanner', compact('model'));
    }
    public function status(Request $request,$status , $id){
        $model = HomeBanner::where('id',$id)->first();
        $model->status=$status;
        $model->save();
        return redirect('admin/HomeBanner')->with("message", "HomeBanner status Updated Successfully");

    }

}
