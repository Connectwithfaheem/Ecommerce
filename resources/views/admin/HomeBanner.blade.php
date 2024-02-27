@extends('admin.layout')
@section('title', 'Home Banner')
@section('HomeBanner_select', 'active')
@section('container')

    <h1>Banner</h1>
    <div class="container m-3"></div>
    <a href="{{ url('admin/manageHomeBanner') }}">
        <button type="button" class="btn btn-success">Add Banner</button>
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
                                    <th>Banner Image</th>
                                    <th>Btn Text</th>
                                    <th>Btn url</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        @if ($data)
                            @foreach ($data as $HomeBanner)
                                <tr>
                                    <td>{{ $HomeBanner->id }}</td>
                                    <td><a  target="_blank" href="{{ asset('HomeBannerImage/'.$HomeBanner->image) }}">
                                        <img width="70px" src="{{ asset('HomeBannerImage/'.$HomeBanner->image) }}" alt="dshc">
                                    </a></td>
                                    <td>{{ $HomeBanner->btn_text }}</td>
                                    <td>{{ $HomeBanner->btn_link }}</td>
                                    <td>
                                        <a href="{{ url('admin/manageHomeBanner/') }}/{{$HomeBanner->id}}" class="btn btn-success">Edit</a>
                                        @if($HomeBanner->status==1)

                                        <a href="{{ url('admin/HomeBanner/status/0') }}/{{$HomeBanner->id}}" class="btn btn-primary">Active</a>
                                        @elseif ($HomeBanner->status==0)
                                        <a href="{{ url('admin/HomeBanner/status/1') }}/{{$HomeBanner->id}}" class="btn btn-warning">Deactive</a>

                                        @endif

                                         <form action="HomeBanner/{{ $HomeBanner->id }}/delete" method="POST" class="d-inline ">
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
