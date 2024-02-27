<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $data = coupon::all();
        return view('admin/coupons', compact('data'));
    }
    public function manage_coupons(Request $request, $id='')
    {
        if($id>0)
        {
            $arr = coupon::where(['id'=>$id])->get();

            $result['title']= $arr['0']->title;
            $result['code']= $arr['0']->code;
            $result['value']= $arr['0']->value;
            $result['type']= $arr['0']->type;
            $result['min_order_amt']= $arr['0']->min_order_amt;
            $result['is_one_time']= $arr['0']->is_one_time;
            $result['id']= $arr['0']->id;
        }else{
            $result['title']= '';
            $result['code']= '';
            $result['value']= '';
            $result['type']= '';
            $result['min_order_amt']= '';
            $result['is_one_time']= '';
            $result['id']= '';
        }


        return view('admin/couponsManage/couponsManage', $result);
    }
    public function couponsInsert(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'code' => 'required|unique:coupons,code,'.$request->post('id'),
            'value' => 'required',


        ]);
        if($request->post('id')>0)
        {
            $model =coupon::find($request->post('id'));
            $msg = "coupon Updated";

        }else{
            $model = new coupon();
            $msg = "coupon Inserted";
            $model->status = 1;

        }
        $model->title = $request->post('title');
        $model->code = $request->post('code');
        $model->value = $request->post('value');
        $model->type = $request->post('type');
        $model->min_order_amt = $request->post('min_order_amt');
        $model->is_one_time = $request->post('is_one_time');

        $model->save();
        return redirect('admin/coupons')->with("message", $msg);
    }

    public function delete($id){
        $model = coupon::where('id',$id)->first();
        $model->delete();
        return redirect('admin/coupons')->with("message", "coupon deleted Successfully");
    }

    public function status(Request $request,$status , $id){
        $model = coupon::where('id',$id)->first();
        $model->status=$status;
        $model->save();
        return redirect('admin/coupons')->with("message", "Coupons status Updated Successfully");

    }


}
