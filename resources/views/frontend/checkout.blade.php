@extends('frontend.layout')
@section('title', 'Checkout Page')
@section('container')

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
   <div class="aa-catg-head-banner-area">
     <div class="container">

     </div>
   </div>
  </section>
  <!-- / catg header banner section -->


  <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form action="" id="frmPlaceOrder">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    @if(session()->has('FRONT_USER_LOGIN')==null)
                    <input type="button" value="Login" class="aa-browse-btn" data-toggle="modal" data-target="#login-modal">
                    <br/><br/>
                    OR
                    <br/><br/>
                    @endif
                    <!-- Shipping Address -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion">
                            User Details Address
                          </a>
                        </h4>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse in">
                        <div class="panel-body">
                         <div class="row">
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder=" Name*"
                                value="{{$customers['name']}}"
                                 name="name" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="email" placeholder="Email Address*"
                                value="{{$customers['email']}}"
                                 name="email" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" placeholder="Phone*"
                                 value="{{$customers['mobile']}}"
                                  name="mobile" required>
                              </div>
                            </div>
                          </div>


                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3" name="address" placeholder="Address" required>
                                    {{ $customers['address'] }}
                                </textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text"  placeholder="City / Town*"
                                 value="{{$customers['city']}}"
                                  name="city" required>
                              </div>
                            </div>
							<div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="State*"
                                 value="{{$customers['state']}}"
                                  name="state" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Postcode / ZIP*"
                                value="{{$customers['zip']}}"
                                 name="zip" required>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $totalPrice=0;
                        @endphp
                        @foreach($cart_data as $list)

                        @php
                        $totalPrice=$totalPrice+($list->price*$list->qty)
                        @endphp

                        <tr>
                          <td>
                            {{$list->name}}
                              <strong>
                                 x  {{$list->qty}}
                                </strong>
                          <br/>
                          <span class="color-aa-color-{{strtolower($list->color)}}">
                            {{$list->color}}
                        </span>
                          </td>
                          <td>
                            {{$list->price*$list->qty}}
                        </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                         <tr class="hide show_coupon_box">
                          <th>Coupon Code <a href="javascript:void(0)" onclick="remove_coupon_code()" class="remove_coupon_code">Remove</a></th>
                          <td id="coupon_code_str">
                        </td>
                        </tr>
                         <tr>
                          <th>Total</th>
                          <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
                          <td id="total_Price">Rs
                            {{$totalPrice}}
                        </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
				  <h4>Coupon Code</h4>
                  <div class="aa-payment-method coupon_code">
                    <input type="text" placeholder="Coupon Code" name="coupon_code" id="coupon_code" class="aa-coupon-code apply_coupon_code_box">
                    <input type="button" onclick="ApplyCoupon()" value="Apply Coupon" class="aa-browse-btn apply_coupon_code_box">
                    <div id="coupon_msg"></div>
                </div>
				  <br/>
                  <h4>Payment Method</h4>
                  <div class="aa-payment-method">
                    <label for="cashdelivery"><input type="radio" id="cashdelivery" value="COD" name="payment_type" checked> Cash on Delivery </label>
                    <label for="Instamojo"><input type="radio" id="Instamojo" name="payment_type" value="Gateway" > Via Paypal </label>
                    <input type="submit" value="Place Order" id="btnPlaceOrder"  class="aa-browse-btn    $data=['name'=>$request->name,'password'=>$rand_id];
                    $user['to']=$request->email;
                    Mail::send('frontend/password_to',$data,function($messages) use ($user){
                    $messages->to($user ['to']);
                    $messages->subject('New Password');
                    });">
                  </div>
                  <div id="order_placed_error_msg">

                  </div>
                </div>
              </div>
            </div>
            @csrf
          </form>
         </div>
       </div>
     </div>
   </div>
 </section>

@endsection
