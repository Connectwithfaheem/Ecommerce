@extends('frontend.layout')
@section('title', 'Daily Shop | Order Placed')
@section('container')
<section id="aa-product-category">
<div class="container">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-8 col-md-push-3">
             <div class="aa-product-catg-content">
                <div class="aa-product-catg-head">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="display-4">Thank You for Your Order!</h2>
                                <p class="lead">We appreciate your business and are excited to have you as our valued customer.</p>

                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Order Confirmed!</h4>
                                    <p>Your order with ID <strong>{{ session()->get('ORDER_ID') }}</strong> has been successfully placed.</p>
                                    <hr>
                                    <p class="mb-0">Thank you for choosing us. Your satisfaction is our priority!</p>
                                </div>

                                <p class="mt-3">You can track the status of your order at any time in your account dashboard.</p>
                                <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Go to Home</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection
