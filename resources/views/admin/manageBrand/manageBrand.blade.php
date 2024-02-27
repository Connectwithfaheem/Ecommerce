@extends('admin.layout')
@section('title', 'Manage Brand')
@section('brand_select', 'active')

@section('container')
    <h1>Brand</h1>
    <div class="container m-3"></div>
    <a href="{{ route('brand') }}">
        <button type="button" class="btn btn-success">Back </button>
    </a>
    {{-- @if ($id > 0)
    {{ $image_required = '' }}
    @else
    {{ $image_required = 'required' }}
    @endif --}}
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row">


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('brandInsert') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="form-group">
                                    <label for="brand" class="control-label mb-1">brand Master</label>
                                    <input id="brand" name="brand" type="text" value="{{$brand}}" class="form-control"
                                        aria-required="true" aria-invalid="false" required >
                                    @error('brand')

                                            {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="image" class="control-label mb-1">Image</label>
                                            <input id="image" name="image" type="file" class="form-control"
                                                aria-required="true" aria-invalid="false">

                                            @error('image')
                                                {{ $message }}
                                            @enderror
                                            @if($image != '')
                                            <a target="_blank" href="{{ asset('brandImage/'.$image) }}"> <img width="70px" src="{{ asset('brandImage/'.$image) }}" alt=""></a>
                                         @endif

                                        </div>




                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Submit
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
