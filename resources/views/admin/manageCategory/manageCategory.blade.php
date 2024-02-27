@extends('admin.layout')
@section('title', 'Manage Category')
@section('category_select', 'active')

@section('container')
    <h1>Category</h1>
    <div class="container m-3"></div>
    <a href="{{ route('category') }}">
        <button type="button" class="btn btn-success">Back Category</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row">


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('categoryInsert') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="category_name" class="control-label mb-1">Category Name</label>
                                            <input id="category" name="category_name" type="text" value="{{$category_name}}" class="form-control"
                                                aria-required="true" aria-invalid="false" required >
                                            @error('category_name')

                                                    {{ $message }}
                                                    @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                            <input id="category_slug" name="category_slug" type="text" value="{{$category_slug}}" class="form-control"
                                                aria-required="true" aria-invalid="false" required>
                                            @error('category_slug')

                                                    {{ $message }}
                                                    @enderror
                                        </div>
                                        <div class="col-lg-4">
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
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="category_image" class="control-label mb-1">category_image</label>
                                            <input id="category_image" name="category_image" type="file" value="{{ $category_image }}"
                                                class="form-control" aria-required="true" aria-invalid="false" >
                                                @if($category_image!= '')
                                                <a target="_blank" href="{{ asset('categoryImage/' . $category_image) }}"> <img width="70px" src="{{ asset('categoryImage/' . $category_image) }}" alt=""></a>
                                             @endif
                                            @error('category_image')
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
