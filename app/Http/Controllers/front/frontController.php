<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use prx;

class frontController extends Controller
{
    public function index()
    {
        $result['category'] = DB::table('categories')->where(['status' => 1])->take(4)->get();
        $result['home_brand'] = DB::table('brands')->where(['status' => 1])->get();

        foreach ($result['category'] as $list) {
            $result['category_product'][$list->id] = DB::table('products')->where(['status' => 1])->where(['category_id' => $list->id])->get();
            foreach ($result['category_product'][$list->id] as $list1) {
                $result['product_attr'][$list1->id] = DB::table('product_attr')
                    ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                    ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
                    ->where(['product_attr.product_id' => $list1->id])
                    ->get();
            }
        }

        $result['featured_product'][$list->id] = DB::table('products')->where(['status' => 1])
            ->where(['is_featured' => 1])->get();
        foreach ($result['featured_product'][$list->id] as $list1) {
            $result['featured_product_attr'][$list1->id] = DB::table('product_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where(['product_attr.product_id' => $list1->id])
                ->get();
        }

        $result['discounted_product'][$list->id] = DB::table('products')->where(['status' => 1])->where(['is_discounted' => 1])->get();
        foreach ($result['discounted_product'][$list->id] as $list1) {
            $result['discounted_product_attr'][$list1->id] = DB::table('product_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where(['product_attr.product_id' => $list1->id])
                ->get();
        }
        $result['trending_product'][$list->id] = DB::table('products')->where(['status' => 1])->where(['is_tranding' => 1])->get();
        foreach ($result['trending_product'][$list->id] as $list1) {
            $result['trending_product_attr'][$list1->id] = DB::table('product_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where(['product_attr.product_id' => $list1->id])
                ->get();
        }

        $result['home_banners'] = DB::table('home_banners')->where(['status' => 1])->get();










        return view('frontend.index', $result);
    }
    public function product(Request $request, $slug)
    {
        $result['product'] = DB::table('products')->where(['status' => 1])->where(['slug' => $slug])->get();
        foreach ($result['product'] as $list1) {
            $result['product_attr'][$list1->id] = DB::table('product_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where(['product_attr.product_id' => $list1->id])
                ->get();
        }
        foreach ($result['product'] as $list1) {
            $result['product_images'][$list1->id] = DB::table('product_images')
                ->where(['product_images.product_id' => $list1->id])
                ->get();
        }
        $result['related_product'] = DB::table('products')
            ->where(['status' => 1])
            ->where('slug', '!=', $slug)
            ->where(['category_id' => $result['product'][0]->category_id])
            ->get();
        foreach ($result['related_product'] as $list1) {
            $result['related_product_attr'][$list1->id] = DB::table('product_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where(['product_attr.product_id' => $result['product'][0]->id])
                ->get();
        }
        $result['product_review'] = DB::table('product_review')
                ->leftJoin('customers', 'customers.id', '=', 'product_review.customer_id')
                ->where(['product_review.product_id' => $list1->id])
                ->orderBy('product_review.id','desc')
                ->where(['product_review.status' => 1])
                ->select('product_review.rating','product_review.review','product_review.added_on','customers.name')
                ->get();

        return view('frontend.product-detail', $result);
    }
    public function add_to_cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');
            $userType = 'Reg';
        } else {
            $uid = getUserTempId();
            $userType = 'NoT-Reg';
        }
        $color_id = $request->post('color_id');
        $size_id = $request->post('size_id');
        $pqty = $request->post('pqty');
        $product_id = $request->post('product_id');

        $result = DB::table('product_attr')
            ->select('product_attr.id')
            ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
            ->where(['product_id' => $product_id])
            ->where(['sizes.size' => $size_id])
            ->where(['colors.color' => $color_id])
            ->get();
        $product_attr_id = $result[0]->id;

        $getAvailableQty =getAvailableQty($product_id,$product_attr_id);

        $finalAvailableQty = $getAvailableQty[0]->pqty-$getAvailableQty[0]->qty;

        if($pqty>$finalAvailableQty)
        {
            return response()->json(['msg' => 'Not_Available', 'data' => 'Only '.$finalAvailableQty.' Qty Available']);
        }


        $check = DB::table('cart')
            ->where(['user_id' => $uid])
            ->where(['user_type' => $userType])
            ->where(['product_id' => $product_id])
            ->where(['product_attr_id' => $product_attr_id])
            ->get();

        if (isset($check[0])) {
            $update_id = $check[0]->id;
            if ($pqty == 0) {
                DB::table('cart')
                    ->where(['id' => $update_id])
                    ->delete();
                $msg = "Removed from Cart";
            } else {
                DB::table('cart')
                    ->where(['id' => $update_id])
                    ->update(['qty' => $pqty]);
                $msg = "Updated To Cart";
            }
        } else {
            $id = DB::table('cart')->insertGetId([
                'user_id' => $uid,
                'user_type' => $userType,
                'product_id' => $product_id,
                'product_attr_id' => $product_attr_id,
                'qty' => $pqty,
                'added_on' => date('Y-m-d h:i:s'),
            ]);
            $msg = "Added To Cart";
        }
        $result = DB::table('cart')
            ->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->leftJoin('product_attr', 'product_attr.id', '=', 'cart.product_attr_id')
            ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
            ->where(['user_id' => $uid])
            ->where(['user_type' => $userType])
            ->select('cart.qty', 'products.name', 'products.image', 'product_attr.price', 'sizes.size', 'colors.color', 'products.slug', 'products.id as pid', 'product_attr.id as attr_id')
            ->get();
        return response()->json(['msg' => $msg, 'data' => $result, 'totalItem' => count($result)]);
    }
    public function cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_LOGIN');
            $userType = 'Reg';
        } else {
            $uid = getUserTempId();
            $userType = 'NoT-Reg';
        }
        $result['list'] = DB::table('cart')
            ->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->leftJoin('product_attr', 'product_attr.id', '=', 'cart.product_attr_id')
            ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
            ->where(['user_id' => $uid])
            ->where(['user_type' => $userType])
            ->select('cart.qty', 'products.name', 'products.image', 'product_attr.price', 'sizes.size', 'colors.color', 'products.slug', 'products.id as pid', 'product_attr.id as attr_id')
            ->get();
        // prx($result);

        return view('frontend.cart', $result);
    }
    public function category(Request $request, $slug)
    {
        $sort = "";
        $sort_txt = "";
        $filter_price_start = "";
        $filter_price_end = "";
        $color_filter = "";
        $colorFilterArr = [];
        if ($request->get('sort') !== null) {
            $sort = $request->get('sort');
        }

        $query = DB::table('products');
        $query = $query->leftJoin('categories', 'categories.id', '=', 'products.category_id');
        $query = $query->leftJoin('product_attr', 'products.id', '=', 'product_attr.product_id');
        $query = $query->where(['products.status' => 1]);
        $query = $query->where(['categories.category_slug' => $slug]);
        if ($sort == 'name') {
            $query = $query->orderBy('products.name', 'asc');
            $sort_txt = "Product Name";
        }
        if ($sort == 'date') {
            $query = $query->orderBy('products.id', 'desc');
            $sort_txt = "Date";
        }
        if ($sort == 'price_desc') {
            $query = $query->orderBy('product_attr.price', 'desc');
            $sort_txt = "Price - DESC";
        }
        if ($sort == 'price_asc') {
            $query = $query->orderBy('product_attr.price', 'asc');
            $sort_txt = "Price - ASC";
        }
        if ($request->get('filter_price_start') !== null && $request->get('filter_price_end') !== null) {
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');

            if ($filter_price_start > 0 && $filter_price_end > 0) {
                $query = $query->whereBetween('product_attr.price', [$filter_price_start, $filter_price_end]);
            }
        }

        if ($request->get('color_filter') !== null) {
            $color_filter = $request->get('color_filter');
            $colorFilterArr = explode(":", $color_filter);
            $colorFilterArr = array_filter($colorFilterArr);

            $query = $query->where(['product_attr.color_id' => $request->get('color_filter')]);
        }

        $query = $query->distinct()->select('products.*');
        $query = $query->get();
        $result['product'] = $query;

        foreach ($result['product'] as $list1) {

            $query1 = DB::table('product_attr');
            $query1 = $query1->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id');
            $query1 = $query1->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id');
            $query1 = $query1->where(['product_attr.product_id' => $list1->id]);
            $query1 = $query1->get();
            $result['product_attr'][$list1->id] = $query1;
        }

        $result['colors'] = DB::table('colors')
            ->where(['status' => 1])
            ->get();


        $result['categories_left'] = DB::table('categories')
            ->where(['status' => 1])
            ->get();

        $result['slug'] = $slug;
        $result['sort'] = $sort;
        $result['sort_txt'] = $sort_txt;
        $result['filter_price_start'] = $filter_price_start;
        $result['filter_price_end'] = $filter_price_end;
        $result['color_filter'] = $color_filter;
        $result['colorFilterArr'] = $colorFilterArr;
        return view('frontend.category', $result);
    }
    public function search(Request $request, $str)
    {
        $result['product'] =
            $query = DB::table('products');
        $query = $query->leftJoin('categories', 'categories.id', '=', 'products.category_id');
        $query = $query->leftJoin('product_attr', 'products.id', '=', 'product_attr.product_id');
        $query = $query->where(['products.status' => 1]);
        $query = $query->where('products.name', 'like', "%$str%");
        $query = $query->orWhere('products.model', 'like', "%$str%");
        $query = $query->orWhere('products.short_desc', 'like', "%$str%");
        $query = $query->orWhere('products.desc', 'like', "%$str%");
        $query = $query->orWhere('products.keywords', 'like', "%$str%");
        $query = $query->orWhere('products.technical_specification', 'like', "%$str%");
        $query = $query->orWhere('products.uses', 'like', "%$str%");
        $query = $query->where(['products.status' => 1]);
        $query = $query->distinct()->select('products.*');
        $query = $query->get();
        $result['product'] = $query;

        foreach ($result['product'] as $list1) {

            $query1 = DB::table('product_attr');
            $query1 = $query1->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id');
            $query1 = $query1->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id');
            $query1 = $query1->where(['product_attr.product_id' => $list1->id]);
            $query1 = $query1->get();
            $result['product_attr'][$list1->id] = $query1;
        }



        // echo "<pre>";
        // print_r($result);
        // die();
        return view('frontend.search', $result);
    }
    public function registration(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            return redirect('/');
        }

        $result = [];
        return view('frontend.registration', $result);
    }
    public function registration_process(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|unique:customers,email',
            'mobile' => 'required|numeric|digits:11',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'error' => $validator->errors()->toArray()]);
        } else {
            $rand_id = rand(111111111, 999999999);

            $arr = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Crypt::encrypt($request->password),
                'status' => 1,
                'is_verified' => 0,
                'rand_id' => $rand_id,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),

            ];
            $query = DB::table('customers')->insert($arr);
            if ($query) {
                $data = ['name' => $request->name, 'rand_id' => $rand_id];
                $user['to'] = $request->email;
                Mail::send('frontend/email_verification', $data, function ($messages) use ($user) {
                    $messages->to($user['to']);
                    $messages->subject('Email Id Verification');
                });
                return response()->json(['status' => 'success', 'msg' => 'Registration Successfully Please Check Your Email For verification']);
            }
        }
    }
    public function login_process(Request $request)
    {
        //  echo "<pre>";
        // print_r($_POST);
        // die();
        $result = DB::table('customers')
            ->where('email', $request->login_email)
            ->get();

        if (isset($result[0])) {
            $db_pwd = Crypt::decrypt($result[0]->password);
            $DBstatus = $result[0]->status;
            $is_verified = $result[0]->is_verified;
            if ($is_verified == 0) {
                return response()->json(['status' => 'error', 'msg' => 'Please Verify Your Email Address']);
            }
            if ($DBstatus == 0) {
                return response()->json(['status' => 'error', 'msg' => 'Your Account has been Deactivated']);
            }

            if ($db_pwd == $request->login_password) {
                if ($request->rememberme === null) {
                    setcookie(
                        'login_email',
                        $request->login_email,
                        60
                    );
                    setcookie(
                        'login_pwd',
                        $request->login_password,
                        60
                    );
                } else {
                    setcookie(
                        'login_email',
                        $request->login_email,
                        time() + 60 * 60 * 24 * 30
                    );
                    setcookie(
                        'login_pwd',
                        $request->login_password,
                        time() + 60 * 60 * 24 * 30
                    );
                }

                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $result[0]->id);
                $request->session()->put('FRONT_USER_NAME', $result[0]->name);
                $status = "success";
                $msg = "Login successful"; // Adjust the success message as needed
                $getUserTempId = getUserTempId();
                DB::table('cart')->where(['user_id' => $getUserTempId, 'user_type' => 'NoT-Reg'])->update(['user_id' => $result[0]->id, 'user_type' => 'Reg']);
            } else {
                $status = "error";
                $msg = "Incorrect password";
            }
        } else {
            $status = "error";
            $msg = "Please enter a valid email address";
        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }
    public function email_verification(Request $request, $id)
    {
        $result = DB::table('customers')
            ->where('rand_id', $id)
            ->get();
        if (isset($result[0])) {
            DB::table('customers')
                ->where(['id' => $result[0]->id])
                ->update(['is_verified' => 1, 'rand_id' => '']);
            return view('frontend/email_verified')->with('success', 'Email Verified Successfully');
        } else {
            return redirect('/');
        }
    }
    public function forget_password(Request $request)
    {
        $result = DB::table('customers')
            ->where('email', $request->forget_email)
            ->get();
        if (isset($result[0])) {
            $rand_id = rand(111111111, 999999999);
            DB::table('customers')
                ->where(['id' => $result[0]->id])
                ->update(['is_forget_password' => 1, 'rand_id' => $rand_id]);

            $data = ['name' => $result[0]->name, 'rand_id' => $rand_id];
            $user['to'] = $request->forget_email;
            Mail::send('frontend/forget_password', $data, function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Forget Password');
            });
            return response()->json(['status' => 'success', 'msg' => 'Please Check Your Email For Reset Password']);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Email Not Found']);
        }
    }
    public function forget_password_change(Request $request, $id)
    {
        $result = DB::table('customers')
            ->where('rand_id', $id)
            ->where('is_forget_password', 1)
            ->get();
        if (isset($result[0])) {
            $request->session()->put('FORGET_PASSWORD_USER_ID', $result[0]->id);
            return view('frontend/forget_password_change')->with('success', 'Email Verified Successfully');
        } else {
            return redirect('/');
        }
    }
    public function forget_password_change_process(Request $request,)
    {

        DB::table('customers')
            ->where(['id' => $request->session()->get('FORGET_PASSWORD_USER_ID')])
            ->update(['is_forget_password' => 0, 'password' => Crypt::encrypt($request->password), 'rand_id' => '']);
        return response()->json(['status' => 'success', 'msg' => 'Password Changed Successfully']);
    }
    public function checkout(Request $request)
    {
        $result['cart_data'] = getAddToCartTotalItem();

        if (isset($result['cart_data'][0])) {
            if ($request->session()->has('FRONT_USER_LOGIN')) {
                $uid = $request->session()->get('FRONT_USER_ID');
                $costumer_info = DB::table('customers')
                    ->where(['id' => $uid])->get();
                // echo "<pre>";
                // print_r($costumer_info);
                // die();

                $result['customers']['name'] = $costumer_info[0]->name;
                $result['customers']['email'] = $costumer_info[0]->email;
                $result['customers']['mobile'] = $costumer_info[0]->mobile;
                $result['customers']['address'] = $costumer_info[0]->address;
                $result['customers']['city'] = $costumer_info[0]->city;
                $result['customers']['state'] = $costumer_info[0]->state;
                $result['customers']['state'] = $costumer_info[0]->state;
                $result['customers']['zip'] = $costumer_info[0]->zip;
            } else {
                $result['customers']['name'] = '';
                $result['customers']['email'] = '';
                $result['customers']['mobile'] = '';
                $result['customers']['address'] = '';
                $result['customers']['city'] = '';
                $result['customers']['state'] = '';
                $result['customers']['state'] = '';
                $result['customers']['zip'] = '';
            }
            return view('frontend.checkout', $result);
        } else {
            return redirect('/');
        }
    }
    public function apply_coupon(Request $request)
    {
        $arr = apply_coupon_code($request->coupon_code);
        $arr = json_decode($arr, true);

        return response()->json(['status' => $arr['status'], 'msg' => $arr['msg'], 'totalPrice' => $arr['totalPrice']]);
    }
    public function remove_coupon_code(Request $request)
    {
        $totalPrice = 0;
        $result = DB::table('coupons')
            ->where('code', $request->coupon_code)
            ->get();
        $getAddToCartTotalItem = getAddToCartTotalItem();
        $totalPrice = 0;
        foreach ($getAddToCartTotalItem as $list) {
            $totalPrice += ($list->qty * $list->price);
        }




        return response()->json(['status' => 'success', 'msg' => 'Coupon Code Is Removed', 'totalPrice' => $totalPrice]);
    }
    public function place_order(Request $request)
    {
        $payment_url = '';
        $rand_id = rand(111111111, 999999999);

        if ($request->session()->has('FRONT_USER_LOGIN')) {
        } else {
            $validator = Validator::make(request()->all(), [
                'email' => 'required|unique:customers,email'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'msg' => 'You Have To Login First Because You Are Registered User']);
            } else {
                $arr = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'password' => Crypt::encrypt($rand_id),
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'status' => 1,
                    'is_verified' => 1,
                    'rand_id' => $rand_id,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s'),

                ];
                $user_id = DB::table('customers')->insertGetId($arr);

                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $user_id);
                $request->session()->put('FRONT_USER_NAME', $request->name);
                // $data=['name'=>$request->name,'password'=>$rand_id];
                // $user['to']=$request->email;
                // Mail::send('frontend/password_to',$data,function($messages) use ($user){
                // $messages->to($user ['to']);
                // $messages->subject('New Password');
                // });
                $getUserTempId = getUserTempId();

                DB::table('cart')->where(['user_id' => $getUserTempId, 'user_type' => 'NoT-Reg'])->update(['user_id' => $user_id, 'user_type' => 'Reg']);
            }
        }
        $coupon_value = 0;
        if ($request->coupon_code != "") {
            $arr = apply_coupon_code($request->coupon_code);
            $arr = json_decode($arr, true);
            if ($arr['status'] == "success") {
                $coupon_value = $arr['coupon_code_value'];
            } else {
                return response()->json(['status' => $arr['status'], 'msg' => $arr['msg']]);
            }
        }
        $uid = $request->session()->get('FRONT_USER_ID');

        $totalPrice = 0;
        $productDetail = [];
        $i = 0;
        $getAddToCartTotalItem = getAddToCartTotalItem();
        foreach ($getAddToCartTotalItem as $list) {
            $totalPrice += ($list->qty * $list->price);
        }
        $arr = [
            'customer_id' => $uid,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->zip,
            'coupon_code' => $request->coupon_code,
            'coupon_value' => $coupon_value,
            'payment_type' => $request->payment_type,
            "total_amount" => $totalPrice,
            'order_status' => 1,
            'payment_status' => 'Pending',
            'added_on' => date('Y-m-d h:i:s'),

        ];
        $order_id = DB::table('pleace_order')->insertGetId($arr);


        if ($order_id > 0) {

            foreach ($getAddToCartTotalItem as $list) {
                $totalPrice += ($list->qty * $list->price);
                $productDetail['product_id'] = $list->pid;
                $productDetail['qty'] = $list->qty;
                $productDetail['price'] = $list->price;
                $productDetail['product_attr_id'] = $list->attr_id;
                $productDetail['qty'] = $list->qty;
                $productDetail['order_id'] = $order_id;
                $i++;
                DB::table('orders_details')->insertGetId($productDetail);
            }
            if($request->payment_type == 'Gateway'){
                $stripe = [
                    'customer_id' => $uid,
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'pincode' => $request->zip,
                    'coupon_code' => $request->coupon_code,
                    'coupon_value' => $coupon_value,
                    'payment_type' => $request->payment_type,
                    "total_amount" => $totalPrice,
                    'order_status' => 1,
                    'payment_status' => 'Pending',
                    'added_on' => date('Y-m-d h:i:s'),

                ];
                $payment_url = url('stripe/getaway');
            }
            DB::table('cart')->where(['user_id' => $uid, 'user_type' => 'Reg'])->delete();

            $request->session()->put('ORDER_ID', $order_id);
            $status = "success";
            $msg = "Order Placed Successfully";
        } else {
            $status = "error";
            $msg = "Something Went Wrong";
        }

        return response()->json(['status' => $status, 'msg' => $msg, 'order_id' => $order_id, 'payment_url' => $payment_url, 'stripe'=>$stripe]);
    }
    public function thanks(Request $request)
    {

        if ($request->session()->has('ORDER_ID')) {
            return view('frontend.thanks');
        } else {
            return redirect('/');
        }
    }
    public function my_order(Request $request)
    {

        $result['orders'] = DB::table('pleace_order')
            ->select('pleace_order.*', 'order_status.order_status')
            ->leftJoin('order_status', 'order_status.id', '=', 'pleace_order.order_status')
            ->where(['pleace_order.customer_id' => $request->session()->get('FRONT_USER_ID')])
            ->get();

        return view('frontend/my_order', $result);
    }
    public function order_detail(Request $request, $id)
    {
        $result['product_details'] = DB::table('orders_details')
            ->select('pleace_order.*', 'orders_details.price', 'orders_details.qty', 'products.name as pname', 'product_attr.attr_image', 'sizes.size', 'colors.color','order_status.order_status','order_status.id')
            ->leftJoin('pleace_order', 'pleace_order.id', '=', 'orders_details.order_id')
            ->leftJoin('product_attr', 'product_attr.id', '=', 'orders_details.product_attr_id')
            ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
            ->leftJoin('products', 'products.id', '=', 'product_attr.product_id')
            ->leftJoin('order_status', 'order_status.id', '=', 'pleace_order.order_status')
            ->where(['pleace_order.id' => $id])
            ->where(['pleace_order.customer_id' => $request->session()->get('FRONT_USER_ID')])
            ->get();
            if(!isset($result['product_details'][0]))
            {
                return redirect('/');
            }

        return view('frontend.order_detail',$result);
    }
    // public function product_review_process(Request $request)
    // {



    //     if ($request->session()->has('FRONT_USER_LOGIN')) {
    //         $uid = $request->session()->get('FRONT_USER_ID');
    //         $arr = [
    //             'rating' => $request->rating,
    //             'review' => $request->review,
    //             'product_id' => $request->product_id,
    //             'customer_id' => $uid,
    //             'added_on' => date('Y-m-d h:i:s'),
    //             'status' => 1,
    //         ];
    //         $query = DB::table('product_review')->insert($arr);
    //             $status = "success";
    //             $msg = "Review Added Successfully";
    //     } else {
    //         $status = "error";
    //         $msg = "You Have To Login First";



    //     }
    //     return response()->json(['status' => $status, 'msg' => $msg]);


    // }
    public function product_review_process(Request $request)
{
    if ($request->session()->has('FRONT_USER_LOGIN')) {
        $uid = $request->session()->get('FRONT_USER_ID');
        $arr = [
            'rating' => $request->rating, // Use the string value of the rating
            'review' => $request->review,
            'product_id' => $request->product_id,
            'customer_id' => $uid,
            'added_on' => now(),
            'status' => 1,
        ];
        $query = DB::table('product_review')->insert($arr);
        $status = "success";
        $msg = "Review Added Successfully";
    } else {
        $status = "error";
        $msg = "You Have To Login First";
    }

    return response()->json(['status' => $status, 'msg' => $msg]);
}

}
