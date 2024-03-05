@extends('frontend.master')
@section('meta_content')
<meta name="title" content="{{$products->product_name}}">
    <meta name="description" content="{{$products->short_desp}}">
    <title>{{$products->product_name}}</title>
    <meta property="og:image" content="{{asset('upload/product/preview')}}/{{$products->preview}}">
    <link rel="image_src" href="{{asset('upload/product/preview')}}/{{$products->preview}}" />
@endsection

@section('content')
<section id="shop_banner" class="text-center" style="background: url('{{asset('frontend/images/shop.jpg')}}') no-repeat center/cover;">
    <div class="container">
        <h3>{{$products->product_name}}</h3>
    </div>
</section>

<!-- ==================== Product Details area start =================== -->
<div class="bradcums">
    <div class="container">
        <ul>
            <li><a href="{{route('index')}}">Home</a>/</li>
            <li><a href="{{route('shop')}}">Shop</a>/</li>
            <li><a>Single Product</a></li>
        </ul>
    </div>
</div>
<section id="details">
    <div class="container">
        <div class="row">
            @php
                if($all_reviews == 0){
                    $avg=0;
                }
                else{
                    $avg = round($all_star/$all_reviews);
                }
            @endphp
            <div class="col-lg-5 col-md-6">
                <div class="details_item">
                    <div class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                            @foreach ($galleries as $gallery)
                            <div class="swiper-slide slide2">
                                <img data-NZoomscale="2" id="NZoomImg" src="{{asset('upload/product/gallery')}}/{{$gallery->gallery}}" />
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($galleries as $gallery)
                            <div class="swiper-slide slide1">
                                <img src="{{asset('upload/product/gallery')}}/{{$gallery->gallery}}" class="w-100 img-fluid" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="details_item2">
                    <form action="{{route('cart.store')}}" method="POST">
                        @csrf
                    <h3>{{$products->product_name}}</h3>
                    <span class="star">
                        @for ($i=1; $i<=$avg; $i++)
                        <i class="fa fa-star"></i>
                        @endfor
                        @for ($i=$avg; $i<=4; $i++)
                        <i class="fa fa-star small"></i>
                        @endfor
                        <span>({{$all_reviews}})</span>
                    </span>
                    <h2>&#2547;{{$products->price}}</h2>
                    <h2><span style="font-size: 24px;" class="text-dark">SKU:{{$products->sku}}</span></h2>
                    <p>{{$products->short_desp}}</p>
                    <div class="cart_button">
                        <div class="quantity">
                            <input type="number" name="quantity" min="1" max="9" step="1" value="1">
                        </div>
                        <input type="hidden" name="product_id" value="{{$products->id}}">
                        <button type="submit" class="cart_btn"><i class="fas fa-shopping-cart"></i>Add to Cart</button>
                        <button type="submit" class="cart_btn"><i class="fas fa-shopping-cart"></i>Order Now</button>
                        <a href="tel:{{$footers->phone}}" class="cart_btn"><i class="fas fa-phone"></i>{{$footers->phone}}</a>
                        <a href="{{$footers->whatsapp_link}}" class="cart_btn"><i class="fa-brands fa-whatsapp"></i>{{$footers->whatsapp}}</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== Product Details area end =================== -->

<!-- ==================== Product Discription area end =================== -->
<section id="product_description">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 m-auto">
                <div class="product_desp ">
                    <ul class="nav nav-pills py-2 justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab"
                                aria-controls="pills-profile" aria-selected="false">Reviews</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        {{-- =============== description ========= --}}
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">{!!$products->long_desp!!}</div>
                        {{-- =========== review =========== --}}
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            @foreach ($reviews as $review)
                            <div class="review_details">
                                <div class="review_main d-flex justify-content-between">
                                    <div class="review_title">
                                        <h4 class="mb-2">{{$review->rel_to_customer->name}}</h4>
                                        <h6 class="mb-3">{{$review->updated_at->format('d-M-Y')}}</h6>
                                    </div>
                                    <div class="rewiew_star">
                                        @for ($i=1; $i<=$review->star; $i++)
                                        <span class="fa fa-star"></span>
                                        @endfor
                                        @for ($i=$review->star; $i<=4; $i++)
                                        <span class="fa fa-star small"></span>
                                        @endfor
                                    </div>
                                </div>
                                {{$review->review}}
                            </div>
                            @endforeach
                            
                            <div class="review_form">
                                @auth ('customer')
                                @if (App\Models\OrderProduct::where('customer_id', Auth::guard('customer')->id())->where('product_id', $products->id)->exists())
                                @if (App\Models\OrderProduct::where('customer_id', Auth::guard('customer')->id())->where('product_id', $products->id)->whereNotNull('review')->first() == false)
                                <form action="{{route('review.store')}}" method="POST">
                                    @csrf
                                 <div class="row">
                                     <div class="col-lg-12">
                                         <h4>Submit Rating</h4>
                                     </div>
                                     <div class="col-lg-12 ">
                                         <div class="revie_stars d-flex align-items-center justify-content-between px-3 py-3 bg-light rounded mb-3 mt-1">
                                             <div class="srt_013">
                                                 <div class="submit-rating">
                                                   <input id="star-5" type="radio" name="rating" class="rating" value="5">
                                                   <label for="star-5" title="5 stars">
                                                     <i class="active fa fa-star" aria-hidden="true"></i>
                                                   </label>
                                                   <input id="star-4" type="radio" name="rating" class="rating" value="4">
                                                   <label for="star-4" title="4 stars">
                                                     <i class="active fa fa-star" aria-hidden="true"></i>
                                                   </label>
                                                   <input id="star-3" type="radio" name="rating" class="rating" value="3">
                                                   <label for="star-3" title="3 stars">
                                                     <i class="active fa fa-star" aria-hidden="true"></i>
                                                   </label>
                                                   <input id="star-2" type="radio" name="rating" class="rating" value="2">
                                                   <label for="star-2" title="2 stars">
                                                     <i class="active fa fa-star" aria-hidden="true"></i>
                                                   </label>
                                                   <input id="star-1" type="radio" name="rating" class="rating" value="1">
                                                   <label for="star-1" title="1 star">
                                                     <i class="active fa fa-star" aria-hidden="true"></i>
                                                   </label>
                                                 </div>
                                             </div>
                                             <div class="srt_014">
                                                <input type="hidden" id="star_value" name="star" value="">
                                                <input type="hidden" name="product_id" value="{{$products->id}}">
                                                 <h6 class="mb-0"><span id="rate">0</span> Star</h6>
                                             </div>
                                         </div>
                                            @error('star')
                                                 <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="mb-3">
                                             <label class="form-label">Your Name</label>
                                             <input readonly value="{{Auth::guard('customer')->user()->name}}"  class="form-control">
                                         </div>
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="mb-3">
                                             <label class="form-label">Your Email</label>
                                             <input readonly value="{{Auth::guard('customer')->user()->email}}" class="form-control">
                                         </div>
                                     </div>
                                     <div class="col-lg-12">
                                         <div class="mb-3">
                                             <label class="form-label">Discription</label>
                                             <textarea name="review" class="form-control"></textarea>
                                         </div>
                                            @error('review')
                                                <strong class="text-danger">{{$message}}</strong>
                                            @enderror
                                     </div>
                                 </div>
                                    <div class="mb-3">
                                        <button style="background: #000; width: 100px;color: #fff;font-weight: 500; font-size: 18px; height: 45px;line-height: 45px; text-align: center; border: 0;">Submit</button>
                                    </div>
                                </form>
                                @else
                                <div class="alert alert-info">
                                    <h3 class="d-flex justify-content-between align-items-center"><strong class="text-dark">You already reated this product!</strong></h3>
                                </div>
                                @endif
                                @else
                                <div class="alert alert-info">
                                    <h3 class="d-flex justify-content-between align-items-center"><strong class="text-dark">You did not purchase this product yet!</strong></h3>
                                </div>
                                @endif
                                @else
                                <div class="alert alert-info">
                                    <h3 class="d-flex justify-content-between align-items-center"><strong class="text-dark">You must login to submit your review!</strong> <a class="btn btn-danger" href="{{route('customer.login')}}">Login</a></h3>
                                </div>
                                @endauth
                             </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ==================== Product Discription area end =================== -->
@endsection

@section('footer_script')
    <script>
        $('.rating').click(function(){
            var star = $(this).val();
            $('#rate').html(star);
            $('#star_value').attr('value', star);
        });
    </script>
@endsection

