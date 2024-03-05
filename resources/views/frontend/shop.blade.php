@extends('frontend.master')
@section('meta_content')
<meta name="title" content="{{$shops->title}}">
    <meta name="description" content="{{$shops->desp}}">
    <title>{{$shops->title}}</title>
    <meta property="og:image" content="{{asset('upload/shop')}}/{{$shops->image}}">
    <link rel="image_src" href="{{asset('upload/shop')}}/{{$shops->image}}" />
@endsection

@section('content')
<section id="shop_banner" class="text-center" style="background: url('{{asset('frontend/images/shop.jpg')}}') no-repeat center/cover;">
    <div class="container">
        <h3>Shop</h3>
    </div>
</section>

<section id="shop">
    <div class="bradcums">
        <div class="container">
            <ul>
                <li><a href="{{route('index')}}">Home</a>/</li>
                <li><a>Shop</a></li>
            </ul>
        </div>
    </div>

    <div class="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="product_heading text-center">
                        <h3>{{$shops->title}}</h3>
                        <p>{{$shops->desp}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                <div class="col-lg-3 col-md-6">
                    <div class="product_item">
                        <div class="product_img">
                            <a href="{{route('single.product', $product->sku)}}"><img src="{{asset('upload/product/preview')}}/{{$product->preview}}" class="w-100 img-fluid" alt=""></a>
                        </div>
                        <div class="product_text">
                            <a href="{{route('single.product', $product->sku)}}">{{substr($product->product_name, 0, 20)}}</a>
                            <span class="star">
                                @php
                                $total_review = App\Models\OrderProduct::where('product_id', $product->id)->whereNotNull('review')->count();
                                $total_star = App\Models\OrderProduct::where('product_id', $product->id)->whereNotNull('review')->sum('star');
                                if($total_review == 0){
                                    $avg = 0;
                                }
                                else{
                                    $avg = round($total_star/$total_review);
                                }
                                @endphp
                                @for ($i=1; $i<=$avg; $i++)
                                        <i class="fas fa-star filled"></i>
                                @endfor
                                @for ($i=$avg; $i<=4; $i++)
                                        <i class="fas fa-star small"></i>
                                @endfor
                                <span>({{$total_review}})</span>
                            </span>
                            <p>&#2547;{{$product->price}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
<!-- ============ shop part end ========== -->
@endsection