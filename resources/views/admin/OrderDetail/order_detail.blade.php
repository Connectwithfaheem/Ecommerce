    @extends('admin.layout')
    @section('title', 'Order Detail')
    @section('category_order', 'active')
    @section('container')

        <h1>Order deatil Detail</h1>
        <div class="container m-3"></div>
        <a href="{{ route('Order') }}">
            <button type="button" class="btn btn-success">Back</button>
        </a>
        <div class="row">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3">
                                <thead>
                                    <tr>
                                        <th><b>Coustomer </b></th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalAmount = 0;
                                    @endphp
                                    @php
                                        $totalAmount += $product_details[0]->price * $product_details[0]->qty;
                                    @endphp
                                    <tr>
                                        <td><b>Order ID</b></td>
                                        <td>{{ $product_details[0]->id }}</td>

                                    </tr>
                                    <tr>
                                        <td><b>Name</b></td>
                                        <td>{{ $product_details[0]->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b></td>
                                        <td>{{ $product_details[0]->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Mobile</b></td>
                                        <td>{{ $product_details[0]->mobile }}</td>

                                    </tr>
                                    <tr>
                                        <td><b>Address</b></td>
                                        <td>{{ $product_details[0]->address }}</td>

                                    </tr>
                                    <tr>
                                        <td><b>City</b></td>
                                        <td>{{ $product_details[0]->city }}</td>

                                    </tr>
                                    <tr>
                                        <td><b>State</b></td>
                                        <td>{{ $product_details[0]->state }}</td>

                                    </tr>
                                    <tr>
                                        <td><b>Zip Code</b></td>
                                        <td>{{ $product_details[0]->pincode }}</td>

                                    </tr>
                                    <tr>
                                        <td><b>Order</b></td>
                                        <td><b>Deatils</b></td>

                                    </tr>
                                    <tr>
                                        <td><b>Order Status</b></td>
                                        <td>{{ $product_details[0]->order_status }}</td>

                                    </tr>
                                    <tr>
                                        <td><b>Payment Type</b></td>
                                        <td>{{ $product_details[0]->payment_type }}</td>

                                    </tr>
                                    <tr>
                                        <td><b>Payment Satus</b></td>
                                        <td>{{ $product_details[0]->payment_status }}</td>

                                    </tr>
                                    <tr>
                                        <td><b>Total Amount</b></td>
                                        <td>{{ $product_details[0]->total_amount }}</td>

                                    </tr>
                                    <tr>
                                        <td><b>Product Name</b></td>
                                        <td>{{ $product_details[0]->pname }}</td>

                                    </tr>
                                    <tr>
                                        <td><b>Product Image</b></td>
                                        <td><img width="50px" height="70px"
                                                src="{{ asset('ProductImage/' . $product_details[0]->attr_image) }}"
                                                alt="{{ $product_details[0]->pname }}"></a></td>

                                    </tr>
                                    <tr>
                                        <td><b>Product Size</b></td>
                                        <td>{{ $product_details[0]->size }}</td>

                                    </tr>
                                    <tr>
                                        <td><b>Product Color</b></td>
                                        <td>{{ $product_details[0]->color }}</td>

                                    </tr>

                                    <?php
                                    if ($product_details[0]->coupon_value > 0) {
                                        echo "<tr>
                                                                                                    <td><b>Coupon <span class='coupon_apply_code_txt' style='color:red;'>(" .
                                            $product_details[0]->coupon_code .
                                            ")</span></b></td>
                                                                                                    <td ><b>" .
                                            $product_details[0]->coupon_value .
                                            "</b></td>
                                                                                                </tr>";
                                        $totalAmount = $totalAmount - $product_details[0]->coupon_value;
                                        echo "<tr>
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
                        <!-- END DATA TABLE-->
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
        <div class="order_operation">
            <h5>

                Update Order Status:
            </h5>
            <select class="form-control" id="order_status" onchange="update_order_status('{{ $product_details[0]->id }}')">
                <?php
                foreach ($order_update_status as $list) {
                    if($product_details[0]->order_status == $list->id) {
                        echo "<option value='".$list->id."' selected>".$list->order_status."</option>";
                    }else {
                        echo "<option value='".$list->id."'>".$list->order_status."</option>";
                    }
                }
                ?>
            </select>
            
            <h5>

                Update Payment Status:
            </h5>
            <select class="form-control" id="payment_status"
                onchange="update_payment_status('{{ $product_details[0]->id }}')">
                <?php
                foreach ($payment_status as $list) {
                    if ($product_details[0]->payment_status == $list) {
                        echo "<option value='$list' selected>$list</option>";
                    } else {
                        echo "<option value='$list'>$list</option>";
                    }
                }
                ?>
            </select>

        </div>

    @endsection
