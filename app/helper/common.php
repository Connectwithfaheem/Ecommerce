<?php

use Illuminate\Support\Facades\DB;

// function prx($arr){
//     echo "<pre>";
//     print_r($arr);
//     die();
// }

function getTopNav()
{
    $result = DB::table('categories')->where(['status' => 1])->get();
    $arr = [];

    foreach ($result as $row) {
        $arr[$row->id]['category_name'] = $row->category_name;
        $arr[$row->id]['parent_id'] = $row->parent_category_id;
        $arr[$row->id]['category_slug'] = $row->category_slug;
    }

    $html = '';
    $str = buildTreeView($arr, 0);
    return $str;
}

$html = '';

function buildTreeView($arr, $parent, $level = 0, $prelevel = -1)
{
    global $html;

    foreach ($arr as $id => $data) {
        if ($parent == $data['parent_id']) {
            if ($level > $prelevel) {
                if ($html == '') {
                    $html .= '<ul class="nav navbar-nav">';
                } else {
                    $html .= '<ul class="dropdown-menu">';
                }
            }

            if ($level == $prelevel && $html != '') {
                $html .= '</li>';
            }

            $html .= '<li><a href="' . url('category/' . $data['category_slug']) . '">' . $data['category_name'] . '<span class="caret"></span></a>';

            if ($level > $prelevel) {
                $prelevel = $level;
            }

            $level++;
            buildTreeView($arr, $id, $level, $prelevel);
            $level--;
        }
    }

    if ($level == $prelevel && $html != '') {
        $html .= '</li></ul>';
    }

    return $html;
}
function getUserTempId(){
    if(session()->has('USER_TEMP_ID')===null){
        $rand = rand(111111111,999999999);
        session()->get('USER_TEMP_ID',$rand);
        return $rand;
    }else{
         return session()->has('USER_TEMP_ID');
    }
}
function getAddToCartTotalItem()
{
    if (session()->has('FRONT_USER_LOGIN')) {
        $uid = session()->get('FRONT_USER_ID');
        $userType = 'Reg';
    } else {
        $uid = getUserTempId();
        $userType = 'NoT-Reg';
    }

    $result = DB::table('cart')
    ->where(['user_id' => $uid])
    ->where(['user_type' => $userType])
    ->get();


    $result = DB::table('cart')
    ->leftJoin('products','products.id','=','cart.product_id')
    ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
    ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
    ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
    ->where(['user_id' =>$uid])
    ->where(['user_type' =>$userType])
    ->select('cart.qty','products.name','products.image','product_attr.price','sizes.size','colors.color','products.slug','products.id as pid','product_attr.id as attr_id')
    ->get();

    return ($result);


}
function apply_coupon_code($coupon_code){
    $totalPrice = 0;
    $result = DB::table('coupons')
    ->where('code', $coupon_code)
    ->get();

    if (isset($result[0])) {
        $type = $result[0]->type;
        $value = $result[0]->Value;

        if($result[0]->status==1){
            if($result[0]->is_one_time==1){
                $status = "error";
                $msg = "Coupon Code is all ready used";
             }else{
                $min_order_amt = $result[0]->min_order_amt;
                if($min_order_amt>0){
                    $getAddToCartTotalItem = getAddToCartTotalItem();

                    $totalPrice = 0;
                    foreach($getAddToCartTotalItem as $list){
                        $totalPrice += ($list->qty * $list->price);
                    }
                    if($min_order_amt<$totalPrice){
                        $status = "success";
                        $msg = "Coupon Code is Applied";
                    }else{
                        $status = "error";
                        $msg = "Minimum Order Amount is ".$min_order_amt;

                    }

                    }else{
                    $status = "success";
                    $msg = "Coupon Code is Applied";
                }
            }
            }else{
            $status = "error";
            $msg = "Coupon Code is Deactivated";
        }
        }else{
        $status = "error";
        $msg = "Please enter a valid coupon code";
    }
    $coupon_code_value =0;
    if($status == 'success'){
        if($type=='per'){
            $discount = ($value/100) * $totalPrice;
            $totalPrice = round($totalPrice - $discount);
            $coupon_code_value = $discount;
        }
        if($type=='value'){
            $totalPrice = $totalPrice - $value;
            $coupon_code_value = $value;
        }
    }
    return json_encode(['status' => $status, 'msg' => $msg,'totalPrice'=>$totalPrice, 'coupon_code_value'=>$coupon_code_value]);

}
function getAvailableQty($product_id,$attr_id){
    $result = DB::table('orders_details')
    ->leftJoin('pleace_order','pleace_order.id','=','orders_details.product_id')
    ->leftJoin('product_attr','product_attr.id','=','orders_details.product_attr_id')
    ->where(['orders_details.product_id' =>$product_id])
    ->where(['orders_details.product_attr_id' =>$attr_id])
    ->select('orders_details.qty','product_attr.qty as pqty')
    ->get();

    return ($result);


}
?>
