@extends('frontend.master')
@section('meta_content')
<meta name="title" content="{{$banners->page_title}}">
    <meta name="description" content="{{$banners->desp}}">
    <title>{{$banners->page_title}}</title>
    <meta property="og:image" content="{{asset('upload/banner')}}/{{$banners->image}}">
    <link rel="image_src" href="{{asset('upload/banner')}}/{{$banners->image}}" />
@endsection

@section('content')
     <!-- =====================Banner Part Start ========================-->
     <section id="banner">
        <div class="container">
            <div class="row banner_row">
                <div class="banner_info">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="banner-content">
                                <div class="b-title">
                                    <h4>{{$banners->title}}</h4>
                                </div>
                                <div class="b-desp">
                                    <h5>{{$banners->desp}}</h5>
                                </div>
                                <div class="b-btn">
                                    <a href="#">Get Started</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="col-lg-9 m-auto">
                                    <div class="banner-img">
                                        <img src="{{asset('upload/banner')}}/{{$banners->image}}" class="d-block w-100 img-fluid" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- =====================Banner  Part  end ========================-->

    <!-- ============================= about part start ===================== -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="about_heading text-center">
                        <h2>{{$conten1->head}}</h2>
                        <p>{{$conten1->head_desp}}</p>
                    </div>
                </div>
            </div>

            <div class="about_content">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="about_img">
                            <img src="{{asset('upload/content1')}}/{{$conten1->image}}" class="w-100 img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="about_text">
                            <h3>{{$conten1->title}}</h3>
                            <p>{{$conten1->desp}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================= about part end ===================== -->

    <!-- ============================= about part start ===================== -->
    <section id="about" style="padding: 0px 0px;">
        <div class="details_product">
            <div class="container">
                <div class="about_content" style="margin-top: 0;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="about_text product">
                                <h3>{{$conten2->title}}</h3>
                                <p>{{$conten2->desp}}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="about_img">
                                <img src="{{asset('upload/content2')}}/{{$conten2->image}}" class="w-100 img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================= about part end ===================== -->

    <!-- ============================= expertise part start ===================== -->
    <section id="expertise">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="expertise_content text-center">
                        <h3>{{$conten3->title}}</h3>
                        <p>{{$conten3->desp}}</p>
                        <div class="row mt-5">
                            <div class="col-lg-10 col-md-10 m-auto">
                                <div class="exper_img">
                                    <img src="{{asset('upload/content3')}}/{{$conten3->image}}" class="w-100 img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================= expertise part end ===================== -->
@endsection