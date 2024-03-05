@extends('frontend.master')
@section('meta_content')
    <title>Order Success</title>
@endsection

@section('content')
<section id="shop_banner" class="text-center" style="background: url('{{asset('frontend/images/shop.jpg')}}') no-repeat center/cover;">
    <div class="container">
        <h3>Order Success</h3>
    </div>
</section>

<!-- ==================== Product Details area start =================== -->
<div class="bradcums">
    <div class="container">
        <ul>
            <li><a href="{{route('index')}}">Home</a>/</li>
            <li><a href="{{route('shop')}}">Shop</a>/</li>
            <li><a>Order Success</a></li>
        </ul>
    </div>
</div>

<section id="simple-form">
    <div class="container">
       <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="order_success_item text-center">
                <i class="fa-solid fa-heart text-success"></i>
                <h3>Your Order is Completed!</h3>
                <p>Your order has been completed. Your Order ID is #{{$order_id}}</p>
                <a href="{{route('shop')}}">Shop Again</a>
            </div>
        </div>
       </div>
    </div>
</section>
@endsection