@extends('admin.layout')
@section('title', 'Manage Coupon')
@section('coupons_select', 'active')


@section('container')
    <h1>Coupon</h1>
    <div class="container m-3"></div>
    <a href="{{ route('coupons') }}">
        <button type="button" class="btn btn-success">Back Coupon</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row">


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('couponsInsert') }}" method="post" novalidate="novalidate">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="title" class="control-label mb-1">Title</label>
                                            <input id="title" name="title" type="text" value="{{ $title }}"
                                                class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('title')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="code" class="control-label mb-1">Code</label>
                                            <input id="code" name="code" type="text" value="{{ $code }}"
                                                class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('code')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="value" class="control-label mb-1">Value</label>
                                            <input id="value" name="value" type="text" value="{{ $value }}"
                                                class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('value')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                                <div class="col-md-6">
                                                    <label for="type" class="control-label mb-1">type</label>
                                                    <select id="type" name="type" type="text"
                                                        class="form-control" aria-required="true" aria-invalid="false"
                                                        required>
                                                        @if ($type == 'value')
                                                            <option value="value" selected>value</option>
                                                            <option value="per">percent</option>
                                                        @elseif($type == 'per')
                                                            <option value="value">value</option>
                                                            <option value="per" selected>percent</option>
                                                        @else
                                                            <option value="value">value</option>
                                                            <option value="per">percent</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="min_order_amt" class="control-label mb-1">Min Order
                                                        Amt</label>
                                                        <input id="min_order_amt" name="min_order_amt" type="text" value="{{ $min_order_amt }}"
                                                        class="form-control" aria-required="true" aria-invalid="false" required>
                                                    @error('min_order_amt')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="is_one_time" class="control-label mb-1">Is One Time</label>
                                                    <select id="is_one_time" name="is_one_time" is_one_time="text"
                                                        class="form-control" aria-required="true" aria-invalid="false"
                                                        required>
                                                        @if ($is_one_time == '1')
                                                            <option value="1" selected>yes</option>
                                                            <option value="0">No</option>
                                                        @elseif($is_one_time == '0')
                                                            <option value="1">yes</option>
                                                            <option value="0" selected>No</option>
                                                        @else
                                                            <option value="1">yes</option>
                                                            <option value="0">No</option>
                                                        @endif
                                                    </select>
                                                </div>

                                    </div>
                                </div>
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
