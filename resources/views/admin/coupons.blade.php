@extends('admin.layout')
@section('title', 'Coupon')
@section('coupons_select', 'active')
@section('container')

    <h1>Coupon</h1>
    <div class="container m-3"></div>
    <a href="{{ url('admin/manageCoupons') }}">
        <button type="button" class="btn btn-success">Add Coupon</button>
    </a>
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
                                        <th>Title</th>
                                        <th>Code</th>
                                        <th>Value</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data)
                                        @foreach ($data as $coupons)
                                            <tr>
                                                <td>{{ $coupons->id }}</td>
                                                <td>{{ $coupons->title }}</td>
                                                <td>{{ $coupons->code }}</td>
                                                <td>{{ $coupons->value }}</td>
                                                <td>
                                                    <a href="{{ url('admin/manageCoupons/') }}/{{ $coupons->id }}"
                                                        class="btn btn-success">Edit</a>

                                                    @if ($coupons->status == 1)
                                                        <a href="{{ url('admin/coupons/status/0') }}/{{ $coupons->id }}"
                                                            class="btn btn-primary">Active</a>
                                                    @elseif ($coupons->status == 0)
                                                        <a href="{{ url('admin/coupons/status/1') }}/{{ $coupons->id }}"
                                                            class="btn btn-warning">Deactive</a>
                                                    @endif


                                                    <form action="coupons/{{ $coupons->id }}/delete" method="POST"
                                                        class="d-inline ">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger deleteBtn"> <i
                                                                class="fas fa-trash"></i>DELETE</button>
                                                    </form>

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
