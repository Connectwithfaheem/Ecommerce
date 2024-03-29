@extends('admin.layout')
@section('title', 'Category')
@section('category_select', 'active')
@section('container')

    <h1>Category</h1>
    <div class="container m-3"></div>
    <a href="{{ url('admin/manageCategory') }}">
        <button type="button" class="btn btn-success">Add Category</button>
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
                                    <th>Category Name</th>
                                    <th>Category Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        @if ($data)
                            @foreach ($data as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->category_slug }}</td>
                                    <td>




                                        <a href="{{ url('admin/manageCategory/') }}/{{$category->id}}" class="btn btn-success">Edit</a>
                                        @if($category->status==1)

                                        <a href="{{ url('admin/category/status/0') }}/{{$category->id}}" class="btn btn-primary">Active</a>
                                        @elseif ($category->status==0)
                                        <a href="{{ url('admin/category/status/1') }}/{{$category->id}}" class="btn btn-warning">Deactive</a>

                                        @endif

                                         <form action="category/{{ $category->id }}/delete" method="POST" class="d-inline ">
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
