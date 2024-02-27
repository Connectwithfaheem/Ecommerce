<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Reference\Reference;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $data = product::all();
        return view('admin/product', compact('data'));
    }
    public function manage_product(Request $request, $id='')
    {
        if($id>0)
        {
            $arr = product::where(['id'=>$id])->get();

            $result['category_id']= $arr['0']->category_id;
            $result['name']= $arr['0']->name;
            $result['image']= $arr['0']->image;
            $result['slug']= $arr['0']->slug;
            $result['brand']= $arr['0']->brand;
            $result['model']= $arr['0']->model;
            $result['short_desc']= $arr['0']->short_desc;
            $result['desc']= $arr['0']->desc;
            $result['keywords']= $arr['0']->keywords;
            $result['technical_specification']= $arr['0']->technical_specification;
            $result['uses']= $arr['0']->uses;
            $result['warranty']= $arr['0']->warranty;
            $result['lead_time']= $arr['0']->lead_time;
            $result['tax_id']= $arr['0']->tax_id;
            $result['is_promo']= $arr['0']->is_promo;
            $result['is_featured']= $arr['0']->is_featured;
            $result['is_discounted']= $arr['0']->is_discounted;
            $result['is_tranding']= $arr['0']->is_tranding;
            $result['status']= $arr['0']->status;
            $result['id']= $arr['0']->id;

        $result['productAttrArr']=DB::table('product_attr')->where(['product_id'=>$id])->get();
        $productImages =DB::table('product_images')->where(['product_id'=>$id])->get();

            if(!isset($productImages[0])){
                $result['productImages'][0]['id']='';
            $result['productImages'][0]['images']='';

            }else{
                $result['productImages'] = $productImages;
            }
            //$result['productImages']
        // echo '<pre>';
        // print_r($productImages[0]);
        // die();





        }else{
            $result['category_id']= '';
            $result['name']= '';
            $result['image']= '';
            $result['slug']= '';
            $result['brand']= '';
            $result['model']= '';
            $result['short_desc']= '';
            $result['desc']= '';
            $result['keywords']= '';
            $result['technical_specification']= '';
            $result['uses']= '';
            $result['warranty']= '';
            $result['lead_time']= '';
            $result['tax_id']= '';
            $result['is_promo']= '';
            $result['is_featured']= '';
            $result['is_discounted']= '';
            $result['is_tranding']= '';
            $result['status']= '';
            $result['id']= '';

            $result['productAttrArr'][0]['id']='';
            $result['productAttrArr'][0]['product_id']='';
            $result['productAttrArr'][0]['sku']='';
            $result['productAttrArr'][0]['attr_image']='';
            $result['productAttrArr'][0]['mrp']='';
            $result['productAttrArr'][0]['price']='';
            $result['productAttrArr'][0]['qty']='';
            $result['productAttrArr'][0]['size_id']='';
            $result['productAttrArr'][0]['color_id']='';
            $result['productImages'][0]['id']='';
            $result['productImages'][0]['images']='';


        }
            // echo '<pre>';
            // print_r($result);
            // die();

        $result['category']=DB::table('categories')->where(['status'=>1])->get();
        $result['taxes']=DB::table('taxes')->where(['status'=>1])->get();
        $result['sizes']=DB::table('sizes')->where(['status'=>1])->get();
        $result['colors']=DB::table('colors')->where(['status'=>1])->get();
        $result['brands']=DB::table('brands')->where(['status'=>1])->get();

        return view('admin/manageProduct/manageProduct', $result);
    }

public function productInsert(Request $request)
{

        //     <!-- return $request->post();
        //    echo "<pre>";
        //    print_r($request->post());
        //    die(); -->

    $destinationPath = public_path('ProductImage');
    File::makeDirectory($destinationPath, $mode = 0755, true, true);
    if ($request->post('id') > 0) {
        $image_validation = "mimes:png,jpg,jpeg";
    } else {
        $image_validation = "required|mimes:png,jpg,jpeg";
    }

    $request->validate([
        'name' => 'required',
        'slug' => 'required|unique:products,slug,' . $request->post('id'),
        'image' => $image_validation,
        'category_id' => 'required',
        'attr_image.*' => 'nullable|mimes:png,jpg,jpeg', // Add validation rule for attribute image
        'images.*' => 'nullable|mimes:png,jpg,jpeg', // Add validation rule for attribute image
    ]);

    $paidArr = $request->post('paid');
    $skuArr = $request->post('sku');
    $mrpArr = $request->post('mrp');
    $priceArr = $request->post('price');
    $attr_imageArr = $request->post('attr_image');
    $qtyArr = $request->post('qty');
    $size_idArr = $request->post('size_id');
    $color_idArr = $request->post('color_id');

    foreach ($skuArr as $key => $val) {
        $check = DB::table('product_attr')
            ->where('sku', '=', $skuArr[$key])
            ->where('id', '!=', $paidArr[$key])
            ->get();

        if (isset($check[0])) {
            return redirect(request()->headers->get('referer'))->with("sku_error", $skuArr[$key] . ' SKU Already used');
        }
    }

    if ($request->post('id') > 0) {
        $model = product::find($request->post('id'));
        $msg = "Product Updated";
    } else {
        $model = new product();
        $msg = "Product Inserted";
    }

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $ext = $image->extension();
        $product_image_name = time() . '.' . $ext; // Use a different variable name for product image
        $image->move(public_path('ProductImage'), $product_image_name);
        $model->image = $product_image_name; // Assign the product image name to model image
    }

    $model->category_id = $request->post('category_id');
    $model->name = $request->post('name');
    $model->slug = $request->post('slug');
    $model->brand = $request->post('brand');
    $model->model = $request->post('model');
    $model->short_desc = $request->post('short_desc');
    $model->desc = $request->post('desc');
    $model->keywords = $request->post('keywords');
    $model->technical_specification = $request->post('technical_specification');
    $model->uses = $request->post('uses');
    $model->warranty = $request->post('warranty');
    $model->lead_time = $request->post('lead_time');
    $model->tax_id = $request->post('tax_id');
    $model->is_promo = $request->post('is_promo');
    $model->is_featured = $request->post('is_featured');
    $model->is_discounted = $request->post('is_discounted');
    $model->is_tranding = $request->post('is_tranding');
    $model->status = 1;
    $model->save();
    $pid = $model->id;



    foreach ($skuArr as $key => $val) {
        $productAttrArr=[];
        $productAttrArr['product_id'] = $pid;
        $productAttrArr['sku'] = $skuArr[$key];
        $productAttrArr['mrp'] = $mrpArr[$key];
        $productAttrArr['attr_image'] = $attr_imageArr[$key] ?? null; // Use null coalescing operator to assign a default value if not set
        $productAttrArr['price'] = $priceArr[$key];
        $productAttrArr['qty'] = $qtyArr[$key];

        if ($size_idArr[$key] == '') {
            $productAttrArr['size_id'] = 0;
        } else {
            $productAttrArr['size_id'] = $size_idArr[$key];
        }

        if ($color_idArr[$key] == '') {
            $productAttrArr['color_id'] = 0;
        } else {
            $productAttrArr['color_id'] = $color_idArr[$key];
        }

        if ($request->hasFile("attr_image.$key")) {
            $rand = rand('111111111', '9999999999');
            $attr_image = $request->file("attr_image.$key");
            $ext = $attr_image->extension();
            $attr_image_name = $rand . '.' . $ext; // Use a different variable name for attribute image
            $request->file("attr_image.$key")->move($destinationPath, $attr_image_name);
            $productAttrArr['attr_image'] = $attr_image_name; // Assign the attribute image name to product attribute array
        }

        if ($paidArr[$key] != '') {
            DB::table('product_attr')->where(['id' => $paidArr[$key]])->update($productAttrArr);
        } else {
            DB::table('product_attr')->insert($productAttrArr);
        }
    }
    //--------------------------->Product Images Save And Update<-------------------------------//
        $piidArr = $request->post('piid');
    foreach ($piidArr as $key => $val) {
        $productImageArr['product_id'] = $pid;

        if ($request->hasFile("images.$key")) {
            $rand = rand('111111111', '9999999999');
            $images = $request->file("images.$key");
            $ext = $images->extension();
            $attr_image_name = $rand . '.' . $ext; // Use a different variable name for attribute image
            $request->file("images.$key")->move($destinationPath, $attr_image_name);
            $productImageArr['images'] = $attr_image_name; // Assign the attribute image name to product attribute array
        }

        if ($piidArr[$key] != '') {
            DB::table('product_images')->where(['id' => $piidArr[$key]])->update($productImageArr);
        } else {
            DB::table('product_images')->insert($productImageArr);
        }
    }
    //--------------------------->Product Images Save And Update<-------------------------------//


    return redirect('admin/product')->with("message", $msg);
}
    public function delete($id)
    {
        $model = product::where('id',$id)->first();
        $model->delete();
        return redirect('admin/product')->with("message", "Product deleted Successfully");
    }


    public function status(Request $request,$status , $id)
    {
        $model = product::where('id',$id)->first();
        $model->status=$status;
        $model->save();
        return redirect('admin/product')->with("message", "Product status Updated Successfully");

    }
    public function product_attr_delete(Request $request, $paid,$pid)
    {
        DB::table('product_attr')->where(['id'=>$paid])->delete();
        return redirect('admin/manageProduct/'.$pid);
    }
    public function Product_images_delete(Request $request, $paid,$pid)
    {
        DB::table('product_images')->where(['id'=>$paid])->delete();
        return redirect('admin/manageProduct/'.$pid);
    }
     /*   public function productInsert(Request $request)
        {
            //  return $request->post();
            // echo "<pre>";
            // print_r($request->post());
            // die();



            if($request->post('id')>0)
            {
            $image_validation = "mimes:png,jpg,jpeg";
            }else{
            $image_validation = "required|mimes:png,jpg,jpeg";

            }
            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:products,slug,'.$request->post('id'),
                'image' => $image_validation,
                'category_id' => 'required',
                'attr_image.*' => 'mimes:png,jpg,jpeg',
            ]);
            $paidArr = $request->post('paid');
            $skuArr = $request->post('sku');
            $mrpArr = $request->post('mrp');
            $priceArr = $request->post('price');
            $attr_imageArr = $request->post('attr_image');
            $qtyArr = $request->post('qty');
            $size_idArr = $request->post('size_id');
            $color_idArr = $request->post('color_id');
            foreach($skuArr as $key=>$val){
                $check=DB::table('product_attr')->
                where('sku','=',$skuArr[$key])->
                where('id','!=',$paidArr[$key])->get();

                if(isset($check[0])){
                    // $request->session()->flash('sku_error', $skuArr[$key].' SKU Already used');
                    return redirect(request()->headers->get('referer'))->with("sku_error", $skuArr[$key].' SKU Already used');
                }

            }




            if($request->post('id')>0)
            {
                $model =product::find($request->post('id'));
                $msg = "product Updated";
            }else{
                $model = new product();
                $msg = "product Inserted";
            }
            if($request->hasFile('image'))
            {
                $image=$request->file('image');
                $ext=$image->extension();
                $image_name = time().'.'.$ext;
                $image->storeAs('/public/ProductImage', $image_name);
                $model->image = $image_name;

            }




            $model->category_id = $request->post('category_id');
            $model->name = $request->post('name');
            $model->slug = $request->post('slug');
            $model->brand = $request->post('brand');
            $model->model = $request->post('model');
            $model->short_desc = $request->post('short_desc');
            $model->desc = $request->post('desc');
            $model->keywords = $request->post('keywords');
            $model->technical_specification = $request->post('technical_specification');
            $model->uses = $request->post('uses');
            $model->warranty = $request->post('warranty');
            $model->status = 1;
            $model->save();
            $pid=$model->id;






            //---------------------{{ Product Attribute Start   }} -----------------//


            foreach($skuArr as $key=>$val){
                $productAttrArr['product_id']=$pid;
                $productAttrArr['sku']=$skuArr[$key];
                $productAttrArr['mrp']= $mrpArr[$key];
                $productAttrArr['attr_image']= $attr_imageArr[$key];
                $productAttrArr['price']=$priceArr[$key];
                $productAttrArr['qty']=$qtyArr[$key];
                if($size_idArr[$key]=='')
                {
                    $productAttrArr['size_id']=0;
                }else{
                    $productAttrArr['size_id']=$size_idArr[$key];

                }
                if($color_idArr[$key]=='')
                {
                    $productAttrArr['color_id']=0;
                }else{
                    $productAttrArr['color_id']=$color_idArr[$key];

                }
                if($request->hasFile("attr_image.$key")){
                    $rand =rand('111111111', '9999999999');
                    $attr_image = $request->file("attr_image.$key");
                    $ext=$attr_image->extension();
                    $image_name = $rand.'.'.$ext;
                    $request->file("attr_image.$key")->storeAs('/public/ProductImage', $image_name);
                    $model->image = $image_name;
                    $productAttrArr['attr_image'] = $image_name;
                }



                if($paidArr[$key]!=''){
                    DB::table('product_attr')->where(['id'=>$paidArr[$key]])->update($productAttrArr);
                }else{
                    DB::table('product_attr')->insert($productAttrArr);

                }



            }



            //---------------------{{ Product Attribute End   }} -----------------//
            return redirect('admin/product')->with("message", $msg);
        }
        public function productInsert(Request $request)
    {
        if ($request->post('id') > 0) {
            $image_validation = "mimes:png,jpg,jpeg";
        } else {
            $image_validation = "required|mimes:png,jpg,jpeg";
        }

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $request->post('id'),
            'image' => $image_validation,
            'category_id' => 'required',
            'attr_image.*' => 'mimes:png,jpg,jpeg',
        ]);

        $paidArr = $request->post('paid');
        $skuArr = $request->post('sku');
        $mrpArr = $request->post('mrp');
        $priceArr = $request->post('price');
        $attr_imageArr = $request->post('attr_image');
        $qtyArr = $request->post('qty');
        $size_idArr = $request->post('size_id');
        $color_idArr = $request->post('color_id');

        foreach ($skuArr as $key => $val) {
            $check = DB::table('product_attr')
                ->where('sku', '=', $skuArr[$key])
                ->where('id', '!=', $paidArr[$key])
                ->get();

            if (isset($check[0])) {
                return redirect(request()->headers->get('referer'))->with("sku_error", $skuArr[$key] . ' SKU Already used');
            }
        }

        if ($request->post('id') > 0) {
            $model = product::find($request->post('id'));
            $msg = "Product Updated";
        } else {
            $model = new product();
            $msg = "Product Inserted";
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time() . '.' . $ext;
            $image->storeAs('/public/ProductImage', $image_name);
            $model->image = $image_name;
        }

        $model->category_id = $request->post('category_id');
        $model->name = $request->post('name');
        $model->slug = $request->post('slug');
        $model->brand = $request->post('brand');
        $model->model = $request->post('model');
        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->keywords = $request->post('keywords');
        $model->technical_specification = $request->post('technical_specification');
        $model->uses = $request->post('uses');
        $model->warranty = $request->post('warranty');
        $model->status = 1;
        $model->save();
        $pid = $model->id;

        foreach ($skuArr as $key => $val) {
            $productAttrArr['product_id'] = $pid;
            $productAttrArr['sku'] = $skuArr[$key];
            $productAttrArr['mrp'] = $mrpArr[$key];
            $productAttrArr['attr_image'] = $attr_imageArr[$key] ?? null; // Use null if not set
            $productAttrArr['price'] = $priceArr[$key];
            $productAttrArr['qty'] = $qtyArr[$key];

            if ($size_idArr[$key] == '') {
                $productAttrArr['size_id'] = 0;
            } else {
                $productAttrArr['size_id'] = $size_idArr[$key];
            }

            if ($color_idArr[$key] == '') {
                $productAttrArr['color_id'] = 0;
            } else {
                $productAttrArr['color_id'] = $color_idArr[$key];
            }

            if ($request->hasFile("attr_image.$key")) {
                $rand = rand('111111111', '9999999999');
                $attr_image = $request->file("attr_image.$key");
                $ext = $attr_image->extension();
                $image_name = $rand . '.' . $ext;
                $request->file("attr_image.$key")->storeAs('/public/ProductImage', $image_name);
                $model->image = $image_name;
                $productAttrArr['attr_image'] = $image_name;
            }

            if ($paidArr[$key] != '') {
                DB::table('product_attr')->where(['id' => $paidArr[$key]])->update($productAttrArr);
            } else {
                DB::table('product_attr')->insert($productAttrArr);
            }
        }

        return redirect('admin/product')->with("message", $msg);
    }*/
}
