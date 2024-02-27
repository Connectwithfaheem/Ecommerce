<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{
    public function index(Request $request){
        $result['product_review'] = DB::table('product_review')
                ->leftJoin('customers', 'customers.id', '=', 'product_review.customer_id')
                ->leftJoin('products', 'products.id', '=', 'product_review.product_id')
                ->orderBy('product_review.id','desc')
                ->select('product_review.rating','product_review.review','product_review.added_on','customers.name','products.name as pname','product_review.id','product_review.status','products.id as pid')
                ->get();


    return view('admin/ProductReview', $result);
    }


    public function review_status_update(Request $request, $status,$id){
        DB::table('product_review')->where(['id' => $id])->update(['status' => $status]);
        return redirect('admin/productReview');
    }
}
