@extends('admin.layout')
@section('title', 'product')
@section('product_select', 'active')
@section('container')

    <h1>Product</h1>
    <div class="container m-3"></div>
    <a href="{{ url('admin/manageProduct') }}">
        <button type="button" class="btn btn-success">Add Product</button>
    </a>
    @if (session()->has('message'))
    <div class="container m-2">
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"></span>
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
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        @if ($data)
                            @foreach ($data as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->slug }}</td>

                                    <td>
                                        <img width="70px" src="{{ asset('ProductImage/'.$product->image) }}" alt="dshc">
                                    </td>
                                    <td>




                                        <a href="{{ url('admin/manageProduct/') }}/{{$product->id}}" class="btn btn-success">Edit</a>
                                        @if($product->status==1)

                                        <a href="{{ url('admin/product/status/0') }}/{{$product->id}}" class="btn btn-primary">Active</a>
                                        @elseif ($product->status==0)
                                        <a href="{{ url('admin/product/status/1') }}/{{$product->id}}" class="btn btn-warning">Deactive</a>

                                        @endif

                                         <form action="product/{{ $product->id }}/delete" method="POST" class="d-inline ">
                                             @csrf
                                            @method('DELETE')
                                            <button   type="submit" class="btn btn-danger deleteBtn"> <i class="fas fa-trash"></i>DELETE</button>
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
