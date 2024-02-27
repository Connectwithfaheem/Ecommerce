<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('admin/category', compact('data'));
    }
    public function manage_category(Request $request, $id='')
    {
        if($id>0)
        {
            $arr = category::where(['id'=>$id])->get();

            $result['category_name']= $arr['0']->category_name;
            $result['category_slug']= $arr['0']->category_slug;
            $result['parent_category_id']= $arr['0']->parent_category_id;
            $result['category_image']= $arr['0']->category_image;
            $result['id']= $arr['0']->id;

        $result['category']=DB::table('categories')->where(['status'=>1])->where('id','!=',$id)->get();

        }else{
            $result['category_name']= '';
            $result['category_slug']= '';
            $result['parent_category_id']= '';
            $result['category_image']= '';
            $result['id']= '';

        $result['category']=DB::table('categories')->where(['status'=>1])->get();

        }


        return view('admin/manageCategory/manageCategory', $result);
    }
    public function categoryInsert(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_slug' => 'required|unique:Categories,category_slug,'.$request->post('id'),
            'category_image' => 'mimes:png,jpg,jpeg', // Add validation rule for attribute image


        ]);

        if($request->post('id')>0)
        {
            $model =Category::find($request->post('id'));
            $msg = "category Updated";

        }else{
            $model = new Category();
            $msg = "category Inserted";
        }
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $ext = $image->extension();
            $product_image_name = time() . '.' . $ext; // Use a different variable name for product image
            $image->move(public_path('categoryImage'), $product_image_name);
            $model->category_image = $product_image_name; // Assign the product image name to model image
        }
        $model->category_name = $request->post('category_name');
        $model->category_slug = $request->post('category_slug');
        $model->parent_category_id = $request->post('parent_category_id');
        $model->status = 1;

        $model->save();
        return redirect('admin/category')->with("message", $msg);
    }

    public function delete($id){
        $model = category::where('id',$id)->first();
        $model->delete();
        return redirect('admin/category')->with("message", "Category deleted Successfully");
    }

    public function categoryEdit($id)
    {
        $model = category::where('id',$id)->first();
        return view('admin/manageCategory/edit_category', compact('model'));
    }
    public function status(Request $request,$status , $id){
        $model = category::where('id',$id)->first();
        $model->status=$status;
        $model->save();
        return redirect('admin/category')->with("message", "Category status Updated Successfully");

    }
}
