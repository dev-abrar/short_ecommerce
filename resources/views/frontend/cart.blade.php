@extends('frontend.master')
@section('meta_content')
<title>Product Cart</title>
@endsection

@section('content')
    <!-- ============= bradecum =============== -->
    <div class="bradcums">
        <div class="container">
            <ul>
                <li><a href="{{route('index')}}">Home</a>/</li>
                <li><a href="{{route('shop')}}">Shop</a>/</li>
                <li><a>Cart</a></li>
            </ul>
        </div>
    </div>

    <!-- ======================== cart part start ====================== -->
    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <form action="{{route('cart.update')}}" method="POST">
                        @csrf
                       @php
                            $total = 0;
                       @endphp
                    @foreach ($carts as $cart)
                    <div class="product_cart">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <div class="cart_img">
                                    <img src="{{asset('upload/product/preview')}}/{{$cart->rel_to_product->preview}}" class="w-100 img-fluid" alt="">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <div class="cart_text">
                                    <h3>{{$cart->rel_to_product->product_name}}</h3>
                                    <h5>&#2547;{{$cart->rel_to_product->price}} X {{$cart->quantity}}</h5>
                                    <input type="number" name="quantity[{{$cart->id}}]" value="{{$cart->quantity}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="cart_remove">
                            <a href="{{route('cart.delete', $cart->id)}}"><i class="fa-solid fa-xmark"></i></a>
                        </div>
                    </div>
                    @php
                        $total += $cart->rel_to_product->price*$cart->quantity;
                    @endphp
                    @endforeach
                    <div class="total mt-4">
                        <h3>Subtotal: <span class="float-end">&#2547;{{$total}}</span></h3>
                    </div>
                    <button type="submit" class="cart_update">Update</button>
                    <a href="{{route('shop')}}" class="cart_update float-end">Buy More product</a>
                   </form>
                </div>
                <div class="col-lg-6">
                    <div class="order_form">
                        <form action="{{route('order.store')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="hidden" name="customer_id" value="{{Auth::guard('customer')->id()}}">
                                <input type="text" name="phone" class="form-control">
                                @error('phone')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control">
                                @error('address')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Delivery Location</label>
                                <div class="mt-2">
                                    <input class="charge" style="cursor: pointer;" id="radio1" type="radio" name="charge" value="60">
                                    <label style="cursor: pointer;" for="radio1">Inside City</label>
                                </div>
                                <div class="mt-2">
                                    <input class="charge" style="cursor: pointer;" id="radio2" type="radio" name="charge" value="120">
                                    <label style="cursor: pointer;" for="radio2">Outside City</label>
                                </div>
                                @error('charge')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="total mt-4">
                                    <h3 class="item" style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-top:20px; padding-bottom: 20px">Total: <span class="float-end">&#2547;<span id="grand_total">{{$total}}</span></span></h3>
                                </div>
                                <input type="hidden" class="subtotal" name="subtotal" value="{{$total}}">
                            </div>
                            <div class="mb-3">
                                <button type="submit">Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================== cart part end ====================== -->
@endsection

@section('footer_script')
    <script>
        $('.charge').click(function(){
            var charge = $(this).val();
            var subtotal = $('.subtotal').val();
            var total = Number(charge) + Number(subtotal);
            $('#grand_total').html(total);
        });
    </script>
    <script>
           @if(Session::has('cart'))
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true,
            }
                    toastr.success("{!! session('cart') !!}");
            @endif
    </script>
@endsection