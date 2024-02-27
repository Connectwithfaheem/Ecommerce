<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\couponController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\TaxController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\HomeBannerController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductReviewController;
use App\Http\Controllers\front\frontController;
use App\Http\Controllers\front\StripeController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\UserAuth;
use App\Http\Kernel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Route::get('admin/updatePassword', [AdminController::class, 'updatePassword'])->name('updatePassword');
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function(){
//         return view('welcome');
//     });
    //---------------->Front Controller <---------------------//

    Route::get('/', [frontController::class, 'index']);
    Route::get('product/{id}',[frontController::class, 'product']);
    Route::get('MyCart', [frontController::class, 'cart'])->name('cart');
    Route::post('/add_to_cart', [frontController::class, 'add_to_cart'])->name('add_to_cart');
    Route::get('category/{id}',[FrontController::class,'category'])->name('category');
    Route::get('search/{str}',[FrontController::class,'search'])->name('search');
    Route::get('registration',[FrontController::class,'registration'])->name('registration');
    Route::post('registration_process',[FrontController::class,'registration_process'])->name('registration_process');
    Route::post('login_process',[FrontController::class,'login_process'])->name('login_process');
    Route::get('logout', function () {
        session()->forget('FRONT_USER_LOGIN');
        session()->forget('FRONT_USER_ID');
        session()->forget('FRONT_USER_NAME');
        return redirect('/');
    });
    Route::post('product_review_process',[FrontController::class,'product_review_process'])->name('product_review_process');

    Route::group(['middleware'=>'user_auth'], function(){
        Route::get('my_order',[FrontController::class,'my_order'])->name('my_order');
        Route::get('order_detail/{id}',[FrontController::class,'order_detail'])->name('order_detail');


    });

    Route::post('forget_password',[FrontController::class,'forget_password']);
    Route::get('forget_password_change/{id}',[FrontController::class,'forget_password_change']);
    Route::post('/forget_password_change_process',[FrontController::class,'forget_password_change_process']);
    Route::get('checkout',[FrontController::class,'checkout'])->name('checkout');
    Route::post('/apply_coupon',[FrontController::class,'apply_coupon']);
    Route::post('/remove_coupon_code',[FrontController::class,'remove_coupon_code']);
    Route::post('/place_order',[FrontController::class,'place_order']);
    Route::get('thanks',[FrontController::class,'thanks'])->name('thanks');



    //---------------->Front Controller <---------------------//
    //---------------->Stripe Controller <---------------------//
    Route::get('stripe/getaway',[StripeController::class,'stripe']);

    //---------------->Email Verification <---------------------//
    Route::get('/email_verification/{id}', [FrontController::class, 'email_verification']);


    //---------------->Email Verification <---------------------//


Route::post('auth', [AdminController::class, 'auth'])->name('auth');
Route::get('admin', [AdminController::class, 'index']);


Route::group(['middleware'=>'admin_auth'], function(){

    //---------------->admin Controller <---------------------//
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('fail','Logout Successfully');
        return redirect('admin');
    });


    //---------------->Category Controller <---------------------//

    Route::get('admin/category', [CategoryController::class, 'index'])->name('category');
    Route::get('admin/manageCategory', [CategoryController::class, 'manage_category'])->name('manage_category');
    Route::get('admin/manageCategory/{id}', [CategoryController::class, 'manage_category'])->name('manage_category');
    Route::post('admin/categoryInsert', [CategoryController::class, 'categoryInsert'])->name('categoryInsert');
    Route::delete('admin/category/{id}/delete',[CategoryController::class, 'delete']);
    Route::get('admin/category/status/{status}/{id}',[CategoryController::class, 'status']);


    //---------------->Coupon Controller <---------------------//
    Route::get('admin/coupons', [couponController::class, 'index'])->name('coupons');
    Route::get('admin/manageCoupons', [couponController::class, 'manage_coupons'])->name('manage_coupons');
    Route::get('admin/manageCoupons/{id}', [couponController::class, 'manage_coupons'])->name('manage_coupons');
    Route::post('admin/couponsInsert', [couponController::class, 'couponsInsert'])->name('couponsInsert');
    Route::delete('admin/coupons/{id}/delete',[couponController::class, 'delete']);
    Route::get('admin/coupons/status/{status}/{id}',[couponController::class, 'status']);


    //---------------->Size Controller <---------------------//

    Route::get('admin/size', [SizeController::class, 'index'])->name('size');
    Route::get('admin/manageSize', [SizeController::class, 'manage_size'])->name('manage_size');
    Route::get('admin/manageSize/{id}', [SizeController::class, 'manage_size'])->name('manage_size');
    Route::post('admin/sizeInsert', [SizeController::class, 'sizeInsert'])->name('sizeInsert');
    Route::delete('admin/size/{id}/delete',[SizeController::class, 'delete']);
    Route::get('admin/size/status/{status}/{id}',[SizeController::class, 'status']);

        //---------------->Color Controller <---------------------//


    Route::get('admin/color', [ColorController::class, 'index'])->name('color');
    Route::get('admin/manageColor', [ColorController::class, 'manage_color'])->name('manage_color');
    Route::get('admin/manageColor/{id}', [ColorController::class, 'manage_color'])->name('manage_color');
    Route::post('admin/colorInsert', [ColorController::class, 'colorInsert'])->name('colorInsert');
    Route::delete('admin/color/{id}/delete',[ColorController::class, 'delete']);
    Route::get('admin/color/status/{status}/{id}',[ColorController::class, 'status']);

            //---------------->Product Controller <---------------------//

    Route::get('admin/product', [ProductController::class, 'index'])->name('product');
    Route::get('admin/manageProduct', [ProductController::class, 'manage_product'])->name('manage_product');
    Route::get('admin/manageProduct/{id}', [ProductController::class, 'manage_product'])->name('manage_product');
    Route::post('admin/productInsert', [ProductController::class, 'productInsert'])->name('productInsert');
    Route::delete('admin/product/{id}/delete',[ProductController::class, 'delete']);
    Route::get('admin/product/status/{status}/{id}',[ProductController::class, 'status']);
    Route::get('admin/manageProduct/Product_attr_delete/{paid}/{pid}', [ProductController::class, 'product_attr_delete'])->name('manage_product');
    Route::get('admin/manageProduct/Product_images_delete/{paid}/{pid}', [ProductController::class, 'Product_images_delete'])->name('manage_product');

            //---------------->Brand Controller <---------------------//
    Route::get('admin/brand', [BrandController::class, 'index'])->name('brand');
    Route::get('admin/manageBrand', [BrandController::class, 'manage_brand'])->name('manage_brand');
    Route::get('admin/manageBrand/{id}', [BrandController::class, 'manage_brand'])->name('manage_brand');
    Route::post('admin/brandInsert', [BrandController::class, 'brandInsert'])->name('brandInsert');
    Route::delete('admin/brand/{id}/delete',[BrandController::class, 'delete']);
    Route::get('admin/brand/status/{status}/{id}',[BrandController::class, 'status']);

            //---------------->Tax Controller <---------------------//
    Route::get('admin/tax', [TaxController::class, 'index'])->name('tax');
    Route::get('admin/manageTax', [TaxController::class, 'manage_tax'])->name('manage_tax');
    Route::get('admin/manageTax/{id}', [TaxController::class, 'manage_tax'])->name('manage_tax');
    Route::post('admin/taxInsert', [TaxController::class, 'taxInsert'])->name('taxInsert');
    Route::delete('admin/tax/{id}/delete',[TaxController::class, 'delete']);
    Route::get('admin/tax/status/{status}/{id}',[TaxController::class, 'status']);

            //----------------> Customer Controller <---------------------//

    Route::get('admin/customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('admin/customer/show/{id}', [CustomerController::class, 'show'])->name('show');
    Route::get('admin/customer/status/{status}/{id}',[CustomerController::class, 'status']);

    //----------------> HomeBanner Controller <---------------------//
    Route::get('admin/HomeBanner', [HomeBannerController::class, 'index'])->name('HomeBanner');
    Route::get('admin/manageHomeBanner', [HomeBannerController::class, 'manage_HomeBanner'])->name('manage_HomeBanner');
    Route::get('admin/manageHomeBanner/{id}', [HomeBannerController::class, 'manage_HomeBanner'])->name('manage_HomeBanner');
    Route::post('admin/HomeBannerInsert', [HomeBannerController::class, 'HomeBannerInsert'])->name('HomeBannerInsert');
    Route::delete('admin/HomeBanner/{id}/delete',[HomeBannerController::class, 'delete']);
    Route::get('admin/HomeBanner/status/{status}/{id}',[HomeBannerController::class, 'status']);

    //----------------> HomeBanner Controller <---------------------//
    Route::get('admin/Order', [OrderController::class, 'index'])->name('Order');
    Route::get('admin/Order/detail/{id}', [OrderController::class, 'admin_order_detail'])->name('admin_order_detail');
    Route::get('admin/Order/detail/payment_status_update/{payment_status}/{id}', [OrderController::class, 'payment_status_update'])->name('payment_status_update');
    Route::get('admin/Order/detail/order_status_update/{order_status}/{id}', [OrderController::class, 'order_status_update'])->name('payment_status_update');
    //----------------> HomeBanner Controller <---------------------//
    Route::get('admin/productReview', [ProductReviewController::class, 'index'])->name('productReview');
    Route::get('admin/productReview/review_status_update/{status}/{id}', [ProductReviewController::class, 'review_status_update']);




} );
