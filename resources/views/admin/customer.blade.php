@extends('admin.layout')
@section('title', 'customer')
@section('suctomer_select', 'active')
@section('container')

    <h1>Customer</h1>
    <div class="container m-3"></div>

    @if (session()->has('message'))
    <div class="container m-2">
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    </div>
    @endif
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
                                        <th>ID</th>
                                        <th>name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data)
                                        @foreach ($data as $customer)
                                            <tr>
                                                <td>{{ $customer->id }}</td>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->mobile }}</td>
                                                <td>{{ Crypt::decrypt($customer->password) }}</td>
                                                <td>


                                                    <a href="{{ url('admin/customer/show/') }}/{{ $customer->id }}"
                                                        class="btn btn-success">View</a>



                                                    @if ($customer->status == 1)
                                                        <a href="{{ url('admin/customer/status/0') }}/{{ $customer->id }}"
                                                            class="btn btn-primary">Active</a>
                                                    @elseif ($customer->status == 0)
                                                        <a href="{{ url('admin/customer/status/1') }}/{{ $customer->id }}"
                                                            class="btn btn-warning">Deactive</a>
                                                    @endif



                                                </td>
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
