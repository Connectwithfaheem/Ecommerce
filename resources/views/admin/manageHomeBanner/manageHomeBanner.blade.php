@extends('admin.layout')
@section('title', 'Manage Home Banner')
@section('HomeBanner_select', 'active')

@section('container')
    <h1>Home Banner</h1>
    <div class="container m-3"></div>
    <a href="{{ route('HomeBanner') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row">


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('HomeBannerInsert') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="btn_text" class="control-label mb-1">Btn text</label>
                                            <input id="btn_text" name="btn_text" type="text" value="{{$btn_text}}" class="form-control"
                                                aria-required="true" aria-invalid="false" required >
                                            @error('btn_text')

                                                    {{ $message }}
                                                    @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="btn_link" class="control-label mb-1">Btn Link</label>
                                            <input id="btn_link" name="btn_link" type="text" value="{{$btn_link}}" class="form-control"
                                                aria-required="true" aria-invalid="false" required>
                                            @error('btn_link')

                                                    {{ $message }}
                                                    @enderror
                                        </div>
                                        {{-- <div class="col-lg-4">
                                            <label for="parent_category_id" class="control-label mb-1">Parent category</label>
                                            <select id="parent_category_id" name="parent_category_id" type="text" class="form-control"
                                                aria-required="true" aria-invalid="false" required>
                                                <option value="">Select Category</option>
                                                @foreach ($category as $list)
                                                    @if ($parent_category_id == $list->id)
                                                        <option selected value="{{ $list->id }}">
                                                            {{ $list->category_name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $list->id }}">{{ $list->category_name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <label for="image" class="control-label mb-1">image</label>
                                            <input id="image" name="image" type="file" value="{{ $image }}"
                                                class="form-control" aria-required="true" aria-invalid="false" >
                                                @if($image!= '')
                                                <a target="_blank" href="{{ asset('HomeBannerImage/' . $image) }}"> <img width="70px" src="{{ asset('HomeBannerImage/' . $image) }}" alt=""></a>
                                             @endif
                                            @error('image')
                                                {{ $message }}
                                            @enderror
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
