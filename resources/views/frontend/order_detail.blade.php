@extends('frontend.layout')
@section('title', 'Order Detail ')
@section('container')

    <!-- Cart view section -->
    <section id="cart-view">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                        <h3>Delivery Address</h3>
                        Name:  <b> {{ $product_details[0]->name }} <br>
                        Mobile:  <b> {{ $product_details[0]->mobile }} <br>
                        Address:  <b> {{ $product_details[0]->address }} <br>
                        City:  <b> {{ $product_details[0]->city }} <br>
                        Zip:  <b> {{ $product_details[0]->pincode }} <br>
                </div>
                <div class="col-md-6">
                    <div class="order_detail">
                        <h3>Order Detail</h3>
                        Order Status: <b> {{ $product_details[0]->order_status }} </b><br>
                        Payment Status: <b> {{ $product_details[0]->payment_status }} </b> <br>
                        Payment ID: <b> {{ $product_details[0]->id }} </b> <br>

                    </div>

                </div>
                <div class="col-md-12">
                    <div class="cart-view-area">
                        <div class="cart-view-table">
                            <form action="">

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalAmount = 0;
                                            @endphp
                                            @foreach ($product_details as $order_detail)
                                                @php
                                                    $totalAmount += $order_detail->price * $order_detail->qty;
                                                @endphp

                                                <tr>
                                                    <td><a class="aa-cart-title"><img width="250px" height="300px"
                                                                src="{{ asset('ProductImage/' . $order_detail->attr_image) }}"
                                                                alt="polo shirt img">{{ $order_detail->pname }}</a>
                                                        <br>
                                                        @if ($order_detail->size != '')
                                                            <span>Size: {{ $order_detail->size }}</span>
                                                        @endif
                                                        <br>
                                                        @if ($order_detail->color != '')
                                                            <span><a href="javascript:void(0)"
                                                                    class="color-aa-color-{{ strtolower($order_detail->color) }}">{{ $order_detail->color }}</a></span>
                                                        @endif
                                                    </td>
                                                    {{-- <td>{{ $order_detail->name }}</td> --}}
                                                    <td>{{ $order_detail->price }}</td>
                                                    <td>{{ $order_detail->qty }}</td>
                                                    <td>{{ $order_detail->price * $order_detail->qty }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                                <td><b>Total</b></td>
                                                <td><b>{{ $totalAmount }}</b></td>
                                            </tr>
                                            <?php
                                            if ($product_details[0]->coupon_value > 0) {
                                                echo "<tr>
                                                        <td colspan='2'>&nbsp;</td>
                                                        <td><b>Coupon <span class='coupon_apply_code_txt'>(".$product_details[0]->coupon_code.")</span></b></td>
                                                        <td><b>" .
                                                    $product_details[0]->coupon_value .
                                                    "</b></td>
                                                    </tr>";
                                                $totalAmount = $totalAmount - $product_details[0]->coupon_value;
                                                echo "<tr>
                                                        <td colspan='2'>&nbsp;</td>
                                                        <td><b>Final Total</b></td>
                                                        <td><b>" .
                                                    $totalAmount .
                                                    "</b></td>
                                                    </tr>";
                                            }
                                            ?>


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
