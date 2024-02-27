@extends('admin.layout')
@section('title', 'Manage color')
@section('color_select', 'active')

@section('container')
    <h1>color</h1>
    <div class="container m-3"></div>
    <a href="{{ route('color') }}">
        <button type="button" class="btn btn-success">Back </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row">


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('colorInsert') }}" method="post" novalidate="novalidate">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="form-group">
                                    <label for="color" class="control-label mb-1">color Master</label>
                                    <input id="color" name="color" type="text" value="{{$color}}" class="form-control"
                                        aria-required="true" aria-invalid="false" required >
                                    @error('color')

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
