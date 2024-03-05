<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta_content')
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/Jzoom.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{asset('frontend/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
</head>

<body>

    <header class="d-none d-lg-block">
        <!-- ==================== navbar area start =================== -->
        <nav id="navbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        @php
                            $logos = App\Models\Logo::where('status', 1)->first();
                        @endphp
                        <a href="#" class="nav_logo">
                            <img width="130" src="{{asset('upload/logo')}}/{{$logos->logo}}" alt="">
                        </a>
                    </div>
                    <div class="col-lg-4 col-xl-3 ms-auto">
                        @php
                            $footer_info = App\Models\Footer::where('id', 1)->first();
                        @endphp
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="nav_contact">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>Call us now:</span>
                                    <a href="tel: {{$footer_info->phone}}">{{$footer_info->phone}}</a>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="nav_cart">
                                    <span>{{App\Models\Cart::where('customer_id', Auth::guard('customer')->id())->get()->count()}}</span>
                                    <i class="fas fa-shopping-basket fs-lg cart_bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="right_cart">
            <div class="top_cart">
                <h3>Product List</h3>
                <i class="fa-solid fa-xmark cart_close"></i>
            </div>
            @php
                $subtotal = 0;
            @endphp
            <div class="cart_product">
                @foreach (App\Models\Cart::where('customer_id', Auth::guard('customer')->id())->get() as $carts)
                <div class="row">
                    <div class="col-lg-3">
                        <div class="cart_product_img">
                            <img src="{{asset('upload/product/preview')}}/{{$carts->rel_to_product->preview}}" width="80" alt="">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="cart_product_details">
                            <h4>{{$carts->rel_to_product->product_name}}</h4>
                            <span>SKU{{$carts->rel_to_product->sku}}:</span>
                            <h3>&#2547;{{$carts->rel_to_product->price}} X {{$carts->quantity}}</h3>
                            <a href="{{route('cart.delete', $carts->id)}}"><i class="fa-solid fa-xmark "></i></a>
                        </div>
                    </div>
                </div>
                @php
                    $subtotal += $carts->rel_to_product->price*$carts->quantity;
                @endphp
                @endforeach
            </div>
            <div class="cart_total">
                <h5>Total:</h5>
                <h4>&#2547;{{$subtotal}}</h4>
            </div>
            <div class="cart_page_btn">
                <a href="{{route('cart')}}" style="background: #000; width: 100%;color: #fff;font-weight: 500; font-size: 18px; height: 45px;margin-top: 30px;line-height: 45px; text-align: center;">Cart</a>
            </div>
        </div>

        <!-- ========== short header=======  -->
        <section id="short_head" class="nav_bar">
            <div class="container">
                <div class="main_menu">
                    <ul class="d-flex">
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('about')}}">About Us</a></li>
                        <li><a href="{{route('shop')}}">Shop</a></li>
                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                    </ul>
                    <ul class="d-flex">
                        @auth ('customer')
                        <li>
                            <div class="dropdown">
                                <a style="cursor: pointer;" class="login_regis" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{Auth::guard('customer')->user()->name}}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item text-dark" href="{{route('myorder')}}">Myorder</a></li>
                                    <li><a class="dropdown-item text-dark" href="{{route('customer.logout')}}">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        @else
                        <li><a href="{{route('customer.login')}}">Login</a></li>
                        <li><a href="{{route('customer.register')}}">Register</a></li>
                        @endauth
                        
                    </ul>
                </div>
            </div>
        </section>
        <!-- ==================== navbar area end =================== -->
    </header>
   
    <!-- =================== mobile menu ================= -->
    <div class="mobile_menu d-block d-lg-none">
        <div class="mobile_logo">
                <div class="container">
                  <div class="mobile_logo_content">
                    <a href="{{route('index')}}"><img src="{{asset('upload/logo')}}/{{$logos->logo}}" alt=""></a>
                    <i class="fa-solid fa-bars menu_cmn menu_bar"></i>
                  </div>
               </div>
        </div>
        <section id="short_head" class="short_head">
            <div class="mobile_logo">
                <a href="{{route('index')}}"><img src="{{asset('upload/logo')}}/{{$logos->logo}}" alt=""></a>
                <i class="fa-solid fa-xmark menu_cmn menu_close"></i>
            </div>
                <div class="main_menu">
                    <ul>
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('about')}}">About Us</a></li>
                        <li><a href="{{route('shop')}}">Shop</a></li>
                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                        @auth ('customer')
                        <li>
                            <div class="dropdown">
                                <a style="cursor: pointer;" class="login_regis" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{Auth::guard('customer')->user()->name}}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item text-dark" href="{{route('myorder')}}">Myorder</a></li>
                                    <li><a class="dropdown-item text-dark" href="{{route('customer.logout')}}">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        @else
                        <li><a href="{{route('customer.login')}}">Login</a></li>
                        <li><a href="{{route('customer.register')}}">Register</a></li>
                        @endauth
                       
                    </ul>
                </div>
        </section>
    </div>
     
    @yield('content')
    <!-- ============ subsribe part start ========== -->
    <section id="subscribe">
        <div class="subscribe"></div>
        <div class="container">
            <div class="subscirbe_container">
                <div class="subsribe_main">
                    <div class="row">
                        <div class="col-lg-8 m-auto">
                            <div class="sub_form">
                                <form method="POST" action="{{route('subscribe.store')}}">
                                    @csrf
                                    <input type="text" name="email" placeholder="What is your email?">
                                    <button type="submit">Subsribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============ subsribe part end ========== -->
    <!-- ==================== footer area start =================== -->
    <footer id="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-sm-9">
                        <div class="footer_left">
                            <a href="{{route('index')}}">
                                <img src="{{asset('upload/footer')}}/{{$footer_info->image}}" width="130" alt="">
                            </a>
                            <p>{{$footer_info->desp}}</p>
                            <ul>
                                <li><a class="foot_icon" href="tel: {{$footer_info->phone}}"><i class="fas fa-phone-alt"></i>{{$footer_info->phone}}</a>
                                </li>
                                <li><a class="foot_icon" href="mailto: {{$footer_info->email}}"><i class="fas fa-envelope"></i>{{$footer_info->email}}</a>
                                </li>
                                <li> <a class="foot_icon" href="#"><i
                                            class="fa-solid fa-location-dot"></i>{{$footer_info->address}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-3">
                        <h3>Company</h3>
                        <div class="footer_mid">
                            <ul>
                                <li><a href="{{route('index')}}">Home</a></li>
                                <li><a href="{{route('about')}}">About</a></li>
                                <li><a href="{{route('shop')}}">Shop</a></li>
                                <li><a href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <h3>Legal</h3>
                        <div class="footer_mid">
                            <ul>
                                <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
                                <li><a href="{{route('term')}}">Term & Condition</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <h3 class="flick_head">Sponsors</h3>
                        <div class="row">
                            @foreach (App\Models\FooterImage::all(); as $img)
                            <div class="col-lg-4 col-4 mb-3">
                                <a href="{{$img->foot_img_link}}" style="display: inline;">
                                    <div>
                                        <img src="{{asset('upload/footer')}}/{{$img->foot_img}}" class="w-100 img-fluid" alt="">
                                    </div></a>
                            </div>
                            @endforeach
                        </div>
                        <div class="footer_icon">
                            @foreach (App\Models\FooterIcon::all(); as $icon)
                            <a href="{{$icon->icon_link}}"><i class="{{$icon->icon}}"></i></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_btm text-center">
            <p>Copyright © 2023 <a href="www.dominytech.com" style="line-height: 24px; color: #ee1c47;">Dominytech</a> Biggest Directory
                All Right Reserved</p>
        </div>
    </footer>
    <!-- ==================== footer area end =================== -->

    <!-- ==================== footer end =================== -->



    <script src="{{asset('frontend/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/js/Jzoom.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{asset('frontend/js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('frontend/js/script.js')}}"></script>
    @yield('footer_script')
    <script>
         // request call
                @if(Session::has('sub_success'))
                toastr.options =
                {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                }
                        toastr.success("{!! session('sub_success') !!}");
                @endif

                @if(Session::has('sub_error'))
                toastr.options =
                {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                }
                        toastr.error("{!! session('sub_error') !!}");
                @endif
    </script>
</body>

</html>