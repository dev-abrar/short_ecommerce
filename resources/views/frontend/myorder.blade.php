@extends('frontend.master')
@section('meta_content')
    <title>MyOrder</title>
@endsection

@section('content')
        <!-- ============= bradecum =============== -->
        <div class="bradcums">
            <div class="container">
                <ul>
                    <li><a href="{{route('index')}}">Home</a>/</li>
                    <li><a href="{{route('shop')}}">Shop</a>/</li>
                    <li><a>My Order</a></li>
                </ul>
            </div>
        </div>
    
        <!-- ======================== cart part start ====================== -->
        <section id="cart">
            <div class="container">
                @forelse ($orders as $order)
                <div class="row mt-4">
                    <div class="col-lg-8 m-auto">
                        <div class="myorder">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                                    <div class="order_head">
                                        <h5>Order Number</h5>
                                         <h3>{{$order->order_id}}</h3>
                                    </div>
                                          @php
                                        if($order->status == 0){
                                            echo '<h6 class="badge bg-dark">Placed</h6>';
                                        }
                                        elseif ($order->status == 1) {
                                            echo '<h6 class="badge bg-info">Processing</h6>';
                                        }
                                        elseif ($order->status == 2) {
                                            echo '<h6 class="badge bg-primary">Pick UP</h6>';
                                        }
                                        elseif ($order->status == 3) {
                                            echo '<h6 class="badge bg-danger">Ready to Deliver</h6>';
                                        }
                                        else{
                                            echo '<h6 class="badge bg-success">Delivered</h6>';
                                        }
                                    @endphp
                                </div>
                                <div class="card-body">
                                    @foreach (App\Models\OrderProduct::where('order_id', $order->order_id)->get(); as $product)
                                    <div class="order_left">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="order_img">
                                                    <img src="{{asset('upload/product/preview')}}/{{$product->rel_to_product->preview}}" class="w-100 img-fluid" alt="">
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <h3>{{$product->rel_to_product->product_name}}</h3>
                                                <h2>&#2547;{{$product->rel_to_product->price}} X {{$product->quantity}}</h2>
                                                <h4>SKU: {{$product->rel_to_product->sku}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="price">
                                        <h3>Total: <span class="float-end">&#2547;{{$order->total}}</span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <section id="simple-form" style="padding: 0;">
                    <div class="container">
                       <div class="row">
                        <div class="col-lg-8 m-auto">
                            <div class="order_success_item text-center" style="padding: 0;">
                                <i class="fa-solid fa-heart text-success"></i>
                                <h3>You didn't buy any product yet.</h3>
                                <a href="{{route('shop')}}">Buy Now</a>
                            </div>
                        </div>
                       </div>
                    </div>
                </section>
                @endforelse
                <div class="row mt-5">
                    <div class="col-lg-8 m-auto">
                        {{$orders->links()}}
                    </div>
                </div>
            </div>
        </section>
        <!-- ======================== cart part end ====================== -->
@endsection