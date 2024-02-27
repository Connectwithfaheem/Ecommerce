
@extends('frontend.layout')
@section('title', 'Cart Page')
@section('container')

  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   {{-- <img src="frontend_asset\img\banner.jpg" alt="fashion img"> --}}
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Cart Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li class="active">Cart</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
                @if(isset($list[0]))
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                          <th>Product</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Total</th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $row)
                        <tr id="cart_box{{ $row->attr_id }}">
                            <td><a class="aa-cart-title" href="{{ url('product/'.$row->slug) }}"><img  width="250px" height="300px" src="{{ asset('ProductImage/' . $row->image) }}"
                                 alt="polo shirt img">{{ $row->name }}</a>
                                 <br>
                                 @if($row->size != '')
                                    <span>Size: {{ $row->size }}</span>
                                    @endif
                                    <br>
                                    @if($row->color != '')
                                    <span><a href="javascript:void(0)" class="color-aa-color-{{strtolower($row->color)}}">{{ $row->color }}</a></span>
                                    @endif
                                </td>
                            <td>{{ $row->price }}</td>
                            <td><input class="aa-cart-quantity" id="qty{{ $row->attr_id }}" onchange="updateQty('{{ $row->pid }}','{{$row->color }}','{{ $row->size }}','{{ $row->attr_id }}','{{ $row->price }}')" type="number" value="{{ $row->qty }}"></td>
                            <td id="total_price_{{ $row->attr_id }}">{{ $row->price*$row->qty }}</td>
                            <td><a class="remove" href="javascript:void(0)" onclick="deleteCartProduct('{{ $row->pid }}','{{$row->color }}','{{ $row->size }}','{{ $row->attr_id }}')"> <i class="fa fa-close"></i></a>
                            </td>
                        </tr>
                        @endforeach

                      </tbody>
                  </table>
                </div>
                @else
                <h3>No product Found</h3>
                @endif
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">

               <a href="{{ url('checkout') }}" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
 <input type="hidden" id="qty" value="1"/>
 <form id="frmAddToCart">
     <input type="hidden" id="size_id" name="size_id"/>
     <input type="hidden" id="color_id" name="color_id"/>
     <input type="hidden" id="pqty" name="pqty"/>
     <input type="hidden" id="product_id" name="product_id"/>
     @csrf
   </form>


@endsection
