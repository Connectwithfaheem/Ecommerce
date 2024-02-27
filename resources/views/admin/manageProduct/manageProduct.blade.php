@extends('admin.layout')
@section('title', 'Manage Product')
@section('Product_select', 'active')
@section('container')

    <h1>Manage product</h1>
    <div class="container m-3"></div>
    <a href="{{ route('product') }}">
        <button type="button" class="btn btn-success">Back product</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <form action="{{ route('productInsert') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Name</label>
                                    <input id="product" name="name" type="text" value="{{ $name }}"
                                        class="form-control" aria-required="true" aria-invalid="false" required>
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Slug</label>
                                    <input id="custom_url_input" name="slug"  type="text" value="{{ $slug }}"
                                        class="form-control" aria-required="true" aria-invalid="false" required>
                                    @error('slug')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image" class="control-label mb-1">image</label>
                                    <input id="image" name="image" type="file" value="{{ $image }}"
                                        class="form-control" aria-required="true" aria-invalid="false" >
                                        @if($image!= '')
                                        <a target="_blank" href="{{ asset('ProductImage/' . $image) }}"> <img width="70px" src="{{ asset('ProductImage/' . $image) }}" alt=""></a>
                                     @endif
                                    @error('image')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="category_id" class="control-label mb-1">category id</label>
                                            <select id="category_id" name="category_id" type="text" class="form-control"
                                                aria-required="true" aria-invalid="false" required>
                                                <option value="">Select Category</option>
                                                @foreach ($category as $list)
                                                    @if ($category_id == $list->id)
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

                                        <div class="col-md-4">
                                            <label for="brand" class="control-label mb-1">Brands</label>
                                            <select id="brand" name="brand" type="text" class="form-control"
                                                aria-required="true" aria-invalid="false" required>
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $list)
                                                    @if ($brand == $list->id)
                                                        <option selected value="{{ $list->id }}">
                                                            {{ $list->brand }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $list->id }}">{{ $list->brand }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="model" class="control-label mb-1">Model</label>
                                            <input id="model" name="model" type="text" value="{{ $model }}"
                                                class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('model')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="short_desc" class="control-label mb-1">short Desc</label>
                                    <textarea id="short_desc" name="short_desc" type="text" value="" class="form-control summernote" aria-required="true"
                                        aria-invalid="false" required>{{ $short_desc }}</textarea>
                                    @error('short_desc')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="desc" class="control-label mb-1">Description</label>
                                    <textarea id="desc" name="desc" type="text" value="" class="form-control" aria-required="true"
                                        aria-invalid="false" required>{{ $desc }}</textarea>
                                    @error('desc')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keywords" class="control-label mb-1">keywords</label>
                                    <textarea id="keywords" name="keywords" type="text" value="" class="form-control" aria-required="true"
                                        aria-invalid="false" required>{{ $keywords }}</textarea>
                                    @error('keywords')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="technical_specification" class="control-label mb-1">Technical
                                        Specification</label>
                                    <textarea id="technical_specification" name="technical_specification" type="text" value=""
                                        class="form-control" aria-required="true" aria-invalid="false" required>{{ $technical_specification }}</textarea>
                                    @error('technical_specification')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="uses" class="control-label mb-1">uses</label>
                                    <textarea id="uses" name="uses" type="text" value="" class="form-control" aria-required="true"
                                        aria-invalid="false" required>{{ $uses }}</textarea>
                                    @error('uses')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="warranty" class="control-label mb-1">warranty</label>
                                    <textarea id="warranty" name="warranty" type="text" value="" class="form-control" aria-required="true"
                                        aria-invalid="false" required>{{ $warranty }}</textarea>
                                    @error('warranty')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="lead_time" class="control-label mb-1">Lead Time</label>
                                            <input id="lead_time" name="lead_time" type="text" value="{{ $lead_time }}"
                                                class="form-control" >

                                        </div>
                                        <div class="col-md-4">
                                            <label for="tax_id" class="control-label mb-1">Tax Id</label>
                                            <select id="tax_id" name="tax_id" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" required>
                                            <option value="">Select Tax</option>
                                            @foreach ($taxes as $list)
                                                @if ($tax_id == $list->id)
                                                    <option selected value="{{ $list->id }}">
                                                        {{ $list->tax_value }}
                                                    </option>
                                                @else
                                                    <option value="{{ $list->id }}">{{ $list->tax_value }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="is_promo" class="control-label mb-1">Is Promo</label>
                                            <select id="is_promo" name="is_promo" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" required>
                                            @if($is_promo=='1')
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                            @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                            @endif

                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="is_featured" class="control-label mb-1">Is Featured</label>
                                            <select id="is_featured" name="is_featured" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" required>
                                            @if($is_featured=='1')
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                            @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                            @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="is_discounted" class="control-label mb-1">Is Discounted</label>
                                            <select id="is_discounted" name="is_discounted" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" required>
                                            @if($is_discounted=='1')
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                            @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                            @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="is_tranding" class="control-label mb-1">IsTranding</label>
                                            <select id="is_tranding" name="is_tranding" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" required>
                                            @if($is_tranding=='1')
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                            @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                            @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="m-b-10">Product Images</h2>
                    @error('images.*')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                <div class="col-lg-12" >
                    <div class="card"  >
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row" id="product_images_box">
                                    @php

                                    $loop_count_num =1;
                                    @endphp
                                    @foreach ($productImages as $key=>$val)
                                    @php
                                    $loop_count_prev =  $loop_count_num;
                                    $piar = (array)$val;
                                    @endphp
                                    <input id="piid" name="piid[]" type="hidden"  value="{{  $piar['id']  }}">
                                    <div class="col-md-4 product_image_{{ $loop_count_num++ }}" >
                                        <label for="images" class="control-label mb-1">Image</label>
                                        <input id="images" name="images[]" type="file" class="form-control"aria-required="true" aria-invalid="false" required="">
                                        @if($piar['images'] != '')
                                       <a target="_blank" href="{{ asset('ProductImage/' . $piar['images']) }}"> <img width="70px" src="{{ asset('ProductImage/' . $piar['images']) }}" alt=""></a>
                                    @endif
                                    </div>
                                    <div class="col-md-2">
                                        <label for="button"
                                            class="control-label mb-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </label>
                                            @if ( $loop_count_num == 2)

                                            <button type="button" class="btn btn-success p-2 btn-sm  " onclick="add_images_more()">
                                                <i class="fa fa-plus"></i>&nbsp; Add More
                                            </button>
                                            @else
                                            <a href="{{ url('admin/manageProduct/Product_images_delete/') }}/{{  $piar['id']}}/{{ $id }}">

                                                <button type="button" class="btn btn-danger btn-lg" onclick="remove_images_more()">
                                                    <i class="fa fa-minus"></i>&nbsp; Remove
                                                </button>
                                            </a>
                                            @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                    <h2 class="m-b-10">Product Attributes</h2>
                        @if(session()->has('sku_error'))
                        <div class="alert alert-danger">
                            {{ session('sku_error') }}
                        </div>
                        @endif
                        @error('attr_image')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    <div class="col-lg-12" id="product_attr_box">
                        @php

                             $loop_count_num =1;
                        @endphp
                        @foreach ($productAttrArr as $key=>$val)
                        @php
                        $loop_count_prev =  $loop_count_num;
                        $paar = (array)$val;
                        @endphp
                        <input id="paid" name="paid[]" type="hidden"  value="{{  $paar['id']  }}">
                        <div class="card" id="product_attr_{{ $loop_count_num++ }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="sku" class="control-label mb-1">SKU</label>
                                            <input id="sku" name="sku[]" type="text" class="form-control"
                                                aria-required="true" aria-invalid="false" value="{{  $paar['sku']  }}" required="">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="mrp" class="control-label mb-1">MRP</label>
                                            <input id="mrp" name="mrp[]" type="text" value="{{  $paar['mrp']  }}"
                                                class="form-control" aria-required="true" aria-invalid="false" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="price" class="control-label mb-1">Price</label>
                                            <input id="price" name="price[]" type="text"  value="{{  $paar['price']  }}"
                                                class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('price')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="size_id" class="control-label mb-1">Size</label>
                                            <select id="size_id" name="size_id[]" type="text" class="form-control"
                                                aria-required="true" aria-invalid="false">
                                                <option value="">Select </option>
                                                @foreach ($sizes as $list)

                                                @if($paar['size_id']==$list->id )
                                                    <option selected value="{{ $list->id }}">{{ $list->size }}</option>
                                                    @else
                                                    <option  value="{{ $list->id }}">{{ $list->size }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="color_id" class="control-label mb-1">Color</label>
                                            <select id="color_id" name="color_id[]" type="text" class="form-control"
                                                aria-required="true" aria-invalid="false">
                                                <option value="">Select </option>
                                                @foreach ($colors as $list)
                                                @if($paar['color_id']==$list->id )
                                                <option selected value="{{ $list->id }}">{{ $list->color }}</option>
                                                @else
                                                <option  value="{{ $list->id }}">{{ $list->color }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="qty" class="control-label mb-1">qty</label>
                                            <input id="qty" name="qty[]" type="text" value="{{  $paar['qty']  }}"
                                                class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('qty')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <label for="attr_image" class="control-label mb-1">Image</label>
                                            <input id="attr_image" name="attr_image[]" type="file" class="form-control"aria-required="true" aria-invalid="false" required="">
                                            @if($paar['attr_image'] != '')
                                            <img width="70px" src="{{ asset('ProductImage/' . $paar['attr_image']) }}" alt="">
                                        @endif
                                        </div>
                                        <div class="col-md-2">
                                            <label for="button"
                                                class="control-label mb-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                @if ( $loop_count_num == 2)

                                                <button type="button" class="btn btn-success btn-lg" onclick="add_more()">
                                                    <i class="fa fa-plus"></i>&nbsp; Add More
                                                </button>
                                                @else
                                                <a href="{{ url('admin/manageProduct/Product_attr_delete/') }}/{{  $paar['id']}}/{{ $id }}">

                                                    <button type="button" class="btn btn-danger btn-lg" onclick="remove_more()">
                                                        <i class="fa fa-minus"></i>&nbsp; Remove
                                                    </button>
                                                </a>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

            <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        var loop_count=1;
        document.addEventListener("DOMContentLoaded", function() {
            var customUrlInput = document.getElementById("custom_url_input");

            customUrlInput.addEventListener("input", function() {
                var inputValue = customUrlInput.value;
                var lowercasedValue = inputValue.toLowerCase();
                var sanitizedValue = lowercasedValue.replace(/ +(?=[^a-z0-9-])|(?<=[^a-z0-9-]) +/g, "");
                sanitizedValue = sanitizedValue.replace(/[^a-zA-Z0-9-]/g, "-");
                customUrlInput.value = sanitizedValue;
            });
        });
        function add_more() {
            loop_count++;
            var html = '<input id="paid" name="paid[]" type="hidden"><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';
            html +=
                '<div class="col-md-2"><label for="sku" class="control-label mb-1">SKU</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

            html +=
                '<div class="col-md-2"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

            html +=
                '<div class="col-md-2"><label for="price" class="control-label mb-1">Price</label><input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

            var size_id_html = jQuery('#size_id').html();
            size_id_html = size_id_html.replace("selected", "");
            html +=
                '<div class="col-md-3"><label for="size" class="control-label mb-1">Size</label><select id="size_id" name="size_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false">' +
                size_id_html + '</select></div>';

            var color_id_html = jQuery('#color_id').html();
            color_id_html = color_id_html.replace("selected", "");

            html +=
                '<div class="col-md-3"><label for="color" class="control-label mb-1">Color</label><select id="color_id" name="color_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false">' +
                color_id_html + '</select></div>';

            html +=
                '<div class="col-md-2"><label for="qty" class="control-label mb-1">Qty</label><input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
            html +=
                '<div class="col-md-4"><label for="attr_image" class="control-label mb-1">I mage</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required></div>';

           html += '<div class="col-md-2">  <label for="button" class="control-label mb-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick="remove_more(' + loop_count + ')"><i class="fa fa-minus"></i>&nbsp; Remove </button></div>';


            html += '</div></div></div></div>';

            jQuery('#product_attr_box').append(html)
        }
        function remove_more(loop_count){
            jQuery('#product_attr_'+loop_count).remove();
        }
        var  loop_image_count=1;

        function  add_images_more(){
            loop_image_count ++;
            var html =
                '<input id="piid" name="piid[]" type="hidden"  value=""><div class="col-md-4  product_image_'+loop_image_count+'"><label for="images" class="control-label mb-1">Image</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required></div>';

           html += '<div class="col-md-2 product_image_'+loop_image_count+'">  <label for="button" class="control-label mb-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick="remove_images_more(' + loop_image_count + ')"><i class="fa fa-minus"></i>&nbsp; Remove </button></div>';
           jQuery('#product_images_box').append(html)
        }
        function remove_images_more(loop_image_count){
            jQuery('.product_image_'+loop_image_count).remove();
        }



    </script>
@endsection

