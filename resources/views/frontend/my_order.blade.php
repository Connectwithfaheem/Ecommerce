
@extends('frontend.layout')
@section('title', 'My Orders')
@section('container')

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">

               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                          <th>Order ID</th>
                          <th>Order Status</th>
                          <th>Payment Status</th>
                          <th>Total Amt</th>
                          <th>Palced On</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)

                        <tr style="cursor: pointer">

                            <td><a href="{{ url('order_detail') }}/{{ $order->id }}">{{ $order->id }}</a></td>
                            <td>{{ $order->order_status }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{{ $order->added_on }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>

             </form>
             <!-- Cart Total view -->
             {{-- <div class="cart-view-total">

               <a href="{{ url('checkout') }}" class="aa-cart-view-btn">Proced to Checkout</a>
             </div> --}}
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->


@endsection
