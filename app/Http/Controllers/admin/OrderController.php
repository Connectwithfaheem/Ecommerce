<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request){
        $result['orders'] = DB::table('pleace_order')
        ->select('pleace_order.*', 'order_status.order_status')
        ->leftJoin('order_status', 'order_status.id', '=', 'pleace_order.order_status')
        ->get();
        // echo "<pre>";
        // print_r($result['orders']);
        // die();

    return view('admin/orders', $result);
    }
    public function admin_order_detail(Request $request, $id){
        $result['product_details'] = DB::table('orders_details')
        ->select('pleace_order.*', 'orders_details.price', 'orders_details.qty', 'products.name as pname', 'product_attr.attr_image', 'sizes.size', 'colors.color','order_status.order_status')
        ->leftJoin('pleace_order', 'pleace_order.id', '=', 'orders_details.order_id')
        ->leftJoin('product_attr', 'product_attr.id', '=', 'orders_details.product_attr_id')
        ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
        ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
        ->leftJoin('products', 'products.id', '=', 'product_attr.product_id')
        ->leftJoin('order_status', 'order_status.id', '=', 'pleace_order.order_status')
        ->where(['pleace_order.id' => $id])
        ->get();


        $result['order_update_status'] = DB::table('order_status')
        ->get();

        $result['payment_status'] =['Pending', 'Success', 'Failed', 'Refund'];
        // echo "<pre>";
        // print_r($result['product_details']);
        // die();

        return view('admin/OrderDetail/order_detail',$result);

    }
 
    public function order_status_update(Request $request, $order_status,$id){
        DB::table('pleace_order')->where(['id' => $id])->update(['order_status' => $order_status]);
        return redirect('admin/Order/detail/'.$id);
    }
}
