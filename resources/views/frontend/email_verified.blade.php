@extends('frontend.layout')
@section('title', 'Daily Shop | Verify Email')
@section('container')
<section id="aa-product-category">
<div class="container">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-8 col-md-push-3">
             <div class="aa-product-catg-content">
                <div class="aa-product-catg-head">
                    <div class="col-md-12">
                        <div class="card">
                            <h2>Congratulations !</h2>
                            <div class="card-body">
                                <h4>Your email has been successfully verified.</h4>
                                <h4>Thank you for joining our platform.</h4>
                                <a href="{{ url('/') }}" class="btn btn-primary">Go to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection
