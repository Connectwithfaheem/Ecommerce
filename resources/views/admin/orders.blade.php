@extends('admin.layout')
@section('title', 'Orders')
@section('category_order', 'active')
@section('container')

    <h1>Orders</h1>
    <div class="container m-3"></div>
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
                                        <th>Order ID</th>
                                        <th>Coutomer Detail</th>
                                        <th>Total Amount</th>
                                        <th>Order Status</th>
                                        <th>Payment Status</th>
                                        <th>Payment Type</th>
                                        <th>Added On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($orders)
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td><a href="{{ url('admin/Order/detail') }}/{{ $order->id }}">{{ $order->id }}</a></td>
                                                <td><a href="{{ url('admin/Order/detail') }}/{{ $order->id }}">{{ $order->name }}</a></td>
                                                <td>{{ $order->total_amount }}</td>
                                                <td>{{ $order->order_status }}</td>
                                                <td>{{ $order->payment_status }}</td>
                                                <td>{{ $order->payment_type }}</td>
                                                <td>{{ $order->added_on }}</td>
                                                {{-- <td>




                                                    <a href="{{ url('admin/manageorder/') }}/{{ $order->id }}"
                                                        class="btn btn-success">Edit</a>
                                                    @if ($order->status == 1)
                                                        <a href="{{ url('admin/order/status/0') }}/{{ $order->id }}"
                                                            class="btn btn-primary">Active</a>
                                                    @elseif ($tax->status == 0)
                                                        <a href="{{ url('admin/tax/status/1') }}/{{ $tax->id }}"
                                                            class="btn btn-warning">Deactive</a>
                                                    @endif

                                                    <form action="tax/{{ $tax->id }}/delete" method="POST"
                                                        class="d-inline ">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger deleteBtn"> <i
                                                                class="fas fa-trash"></i>DELETE</button>
                                                    </form>

                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE-->
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>

    @endsection
