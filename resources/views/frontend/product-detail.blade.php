@extends('frontend.layout')
@section('title', 'Daily Shop | ' . $product[0]->name)
@section('container')

  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">
                  <div class="aa-product-view-slider">
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="{{ asset('ProductImage/' . $product[0]->image) }}" class="simpleLens-lens-image"><img  src="{{ asset('ProductImage/' . $product[0]->image) }}" class="simpleLens-big-image"></a></div>
                      </div>
                      <div class="simpleLens-thumbnails-container">
                          <a data-big-image="{{ asset('ProductImage/' . $product[0]->image) }}" data-lens-image="{{ asset('ProductImage/' . $product[0]->image) }}" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="{{ asset('ProductImage/' . $product[0]->image) }}" width="50px">
                          </a>
                          @if(isset($product_images[$product[0]->id][0]))
                          @foreach ($product_images[$product[0]->id] as $list)
                          {{-- @php
                            prx($list)

                          @endphp --}}
                          <a data-big-image="{{ asset('ProductImage/' . $list->images) }}" data-lens-image="{{ asset('ProductImage/' . $list->images) }}" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="{{ asset('ProductImage/' . $list->images) }}" width="50px">
                          </a>

                          @endforeach
                          @endif
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{{ $product[0]->name }}</h3>
                    <div class="aa-price-block">
                        <span class="aa-product-view-price"><del>Rs {{ $product_attr[$product[0]->id][0]->mrp }}</del></span>&nbsp;&nbsp;&nbsp;
                      <span class="aa-product-view-price">Rs {{ $product_attr[$product[0]->id][0]->price }}</span>
                      <p class="aa-product-avilability">Availablity: <span>In stock</span></p>
                      @if($product[0]->lead_time!="")
                        <p style="color: red; margin-top:-13px; font-weight:bold;font-size:13px" class="aa-product-avilability">{{ $product[0]->lead_time}}</p>
                      @endif
                    </div>
                    <p>{!! $product[0]->short_desc !!}</p>
                    @if($product_attr[$product[0]->id][0]->size_id>0)
                    <h4>Size</h4>
                    <div class="aa-prod-view-size">
                        @php
                            $arrSize = [];
                            foreach ($product_attr[$product[0]->id] as $attr)
                            {
                                $arrSize[] = $attr->size;
                            }
                            $arrSize=array_unique($arrSize);
                        @endphp
                        @foreach ($arrSize as $attr)
                        @if ($attr!="")
                        <a href="javascript:void(0)" onclick="showColor('{{ $attr }}')" id="size_{{ $attr }}" class="size_link">{{ $attr }}</a>
                        @endif
                        @endforeach

                    </div>
                    @endif
                    @if($product_attr[$product[0]->id][0]->color_id>0)
                    <h4>Color</h4>
                    <div class="aa-color-tag">
                        @foreach ($product_attr[$product[0]->id] as $attr)
                        @if ($attr->color!="")

                          <a href="javascript:void(0)" class="aa-color-{{strtolower($attr->color)}} product_color size_{{ $attr->size }}"
                             onclick="change_product_color_image('{{ asset('ProductImage/'.$attr->attr_image) }}','{{ ($attr->color) }}')"></a>
                      @endif
                      @endforeach
                    </div>
                    @endif
                    <div class="aa-prod-quantity">
                      <form action="">
                        <select id="qty" name="qty">
                            @for ($i=1; $i<11;$i++)
                            <option  value="{{ $i }}">{{ $i }}</option>
                            @endfor

                        </select>
                      </form>
                      <p class="aa-prod-category">
                        Model:<a href="#">{{ $product[0]->model }}</a>
                      </p>
                    </div>
                    <div class="aa-prod-view-bottom">
                      <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_to_cart('{{ $product[0]->id }}','{{ $product_attr[$product[0]->id][0]->size_id }}','{{ $product_attr[$product[0]->id][0]->color_id }}')">Add To Cart</a>
                      <div id="add_to_cart_msg"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#technical_specification" data-toggle="tab">Technical Specification</a></li>
                <li><a href="#uses" data-toggle="tab">Uses</a></li>
                <li><a href="#warranty" data-toggle="tab">Warranty</a></li>
                <li><a href="#review" data-toggle="tab">Reviews</a></li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  {!! $product[0]->desc !!}
                </div>
                <div class="tab-pane fade in active" id="technical_specification">
                  {!! $product[0]->technical_specification !!}
                </div>
                <div class="tab-pane fade in active" id="uses">
                  {!! $product[0]->uses !!}
                </div>
                <div class="tab-pane fade in active" id="warranty">
                  {!! $product[0]->warranty !!}
                </div>
                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">

                   <h4> <div class="countOfReview"> {{ $count = count($product_review); }}</div> Reviews for {!! $product[0]->name !!}</h4>
                   <ul class="aa-review-nav">
                    @if (isset($product_review[0]))
                    @foreach($product_review as $review)
                    <li>
                        <div class="media">
                          <div class="media-body">
                            <h4 class="media-heading"><strong>{{ $review->name }}</strong> - <span>{{ $review->added_on }}</span></h4>
                            <div class="aa-product-rating">
                                @if ($review->rating==1)
                                <div style="color: gold; display: inline-block;">&#9733;</div>
                                @endif
                                @if ($review->rating==2)
                                <div style="color: gold; display: inline-block;">&#9733;&#9733;</div>
                                @endif
                                @if ($review->rating==3)
                                <div style="color: gold; display: inline-block;">&#9733;&#9733;&#9733;</div>
                                @endif
                                @if ($review->rating==4)
                                <div style="color: gold; display: inline-block;">&#9733;&#9733;&#9733;&#9733;</div>
                                @endif
                                @if ($review->rating==5)
                                <div style="color: gold; display: inline-block;">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                                @endif
                             {{-- {{ $review->rating }} --}}
                            </div>
                            <p>{{ $review->review }}</p>
                          </div>
                        </div>
                    </li>
                    @endforeach
                    @else
                    <li>
                        No Reviews Found!
                    </li>
                    @endif


                   </ul>
                   <form id="frmProductReview" class="aa-review-form">
                      @csrf
                        <h4>Add a review</h4>
                        <div class="aa-your-rating">
                            <p>Your Rating</p>
                            <div class="stars" onclick="rateProduct(1)">★</div>
                            <div class="stars" onclick="rateProduct(2)">★</div>
                            <div class="stars" onclick="rateProduct(3)">★</div>
                            <div class="stars" onclick="rateProduct(4)">★</div>
                            <div class="stars" onclick="rateProduct(5)">★</div>
                            <input type="hidden" id="selectedRating" name="rating" required>
                        </div>
                   <!-- review form -->
                        <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" name="review" rows="3" required></textarea>
                      </div>
                      <button style="display: flex;justify-content: center;" type="submit" class="btn btn-default aa-review-submit">Submit <div id="faSpinner"></div></button>
                      <input type="hidden" name="product_id" value="{{ $product[0]->id }}">
                   </form>
                   <div  id="review_msg"></div>
                 </div>
                </div>
              </div>
            </div>
            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">
                    @if (isset($related_product[0]))
                    @foreach($related_product as $productArr)
                    <li>
                        <figure>
                            <a class="aa-product-img" href="{{ url('product/'.$productArr->slug) }}"><img
                                    src="{{ asset('ProductImage/' . $productArr->image) }}"
                                    alt="polo shirt img"></a>
                            <a class="aa-add-card-btn"href="{{ url('product/'.$productArr->slug) }}"><span
                                    class="fa fa-shopping-cart"></span>Add To Cart</a>
                            <figcaption>
                                <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">{{ $productArr->name }}</a></h4>
                                <span class="aa-product-price">Rs {{ $related_product_attr[$productArr->id][0]->price }}</span><span
                                    class="aa-product-price"><del>Rs {{ $related_product_attr[$productArr->id][0]->mrp }}</del></span>
                            </figcaption>
                        </figure>
                    </li>
                    @endforeach
                    @else
                    <li>
                        No Products Found In This Category!
                        </li>
                        @endif
              </ul>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <form id="frmAddToCart">
      @csrf
      <input type="hidden" id="size_id" name="size_id"/>
      <input type="hidden" id="color_id" name="color_id"/>
      <input type="hidden" id="pqty" name="pqty"/>
      <input type="hidden" id="product_id" name="product_id"/>
    </form>
    <script>
        let selectedRating = 0;

        function rateProduct(rating) {
          selectedRating = rating;
          document.getElementById('selectedRating').value = rating;

          // Remove filled class from all stars
          const stars = document.querySelectorAll('.stars');
          stars.forEach(star => star.classList.remove('filled'));

          // Add filled class to the selected stars
          for (let i = 0; i < rating; i++) {
            stars[i].classList.add('filled');
          }
        }
      </script>
@endsection
