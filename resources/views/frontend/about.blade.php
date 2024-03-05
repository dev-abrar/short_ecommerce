@extends('frontend.master')
@section('meta_content')
<meta name="title" content="{{$about->seo_title}}">
    <meta name="description" content="{{$about->desp1}}">
    <title>{{$about->seo_title}}</title>
    <meta property="og:image" content="{{asset('upload/about')}}/{{$about->image}}">
    <link rel="image_src" href="{{asset('upload/about')}}/{{$about->image}}" />
@endsection
@section('content')
<section id="shop_banner" class="text-center" style="background: url('{{asset('frontend/images/shop.jpg')}}') no-repeat center/cover;">
    <div class="container">
        <h3>About Us</h3>
    </div>
</section>


    <!-- ============================= about part start ===================== -->
    <section id="about" style="padding: 0px 0px;">
        <div class="details_product">
            <div class="container">
                <div class="about_content" style="margin-top: 0;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="about_text product">
                                <h3>{{$about->title1}}</h3>
                                <p>{{$about->desp1}}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="about_img">
                                <img src="{{asset('upload/about')}}/{{$about->image}}" class="w-100 img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================= about part end ===================== -->

    <!-- ================== goal part start ======================= -->
    <section id="goal">
        <div class="container">
            <div class="title">
                <h3>{{$about->title2}}</h3>
                <p>{{$about->desp2}}</p>
            </div>
            <div class="title">
                <h3>{{$about->title3}}</h3>
                <p>{{$about->desp3}}</p>
            </div>
            <div class="title">
                <h3>{{$about->title4}}</h3>
                <p>{{$about->desp4}}</p>
            </div>
        </div>
    </section>
    <!-- ================== goal part end ======================= -->
@endsection