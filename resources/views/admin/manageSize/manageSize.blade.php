@extends('admin.layout')
@section('title', 'Manage size')
@section('size_select', 'active')

@section('container')
    <h1>Size</h1>
    <div class="container m-3"></div>
    <a href="{{ route('size') }}">
        <button type="button" class="btn btn-success">Back </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row">


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('sizeInsert') }}" method="post" novalidate="novalidate">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="form-group">
                                    <label for="size" class="control-label mb-1">Size Master</label>
                                    <input id="size" name="size" type="text" value="{{$size}}" class="form-control"
                                        aria-required="true" aria-invalid="false" required >
                                    @error('size')

                                            {{ $message }}
                                            @enderror
                                </div>
                                {{-- <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                <input id="category_slug" name="category_slug" type="text" value="{{$category_slug}}" class="form-control"
                                    aria-required="true" aria-invalid="false" required>
                                @error('category_slug')

                                        {{ $message }}
                                        @enderror
                        </div> --}}



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
