@extends('frontend.master')

@section('meta_content')
<title>Privacy Policy</title>
@endsection

@section('content')
<section id="shop_banner" class="text-center" style="background: url('{{asset('frontend/images/shop.jpg')}}') no-repeat center/cover;">
    <div class="container">
        <h3>Term & Condition</h3>
    </div>
</section>

<section  style="padding: 100px 0 140px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-details-content">
                     {!!$term->desp!!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection