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

                            <form action="{{ route('taxInsert') }}" method="post" novalidate="novalidate">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="form-group">
                                    <label for="tax_desc" class="control-label mb-1">Tax Description</label>
                                    <input id="tax_desc" name="tax_desc" type="text" value="{{$tax_desc}}" class="form-control"
                                        aria-required="true" aria-invalid="false" required >
                                    @error('tax_desc')
                                            {{ $message }}
                                            @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tax_value" class="control-label mb-1">Tax Value </label>
                                    <input id="tax_value" name="tax_value" type="text" value="{{$tax_value}}" class="form-control"
                                        aria-required="true" aria-invalid="false" required >
                                    @error('tax_value')

                                            {{ $message }}
                                            @enderror
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
