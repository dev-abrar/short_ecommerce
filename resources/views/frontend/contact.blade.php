@extends('frontend.master')
@section('meta_content')
<title>Contact Us</title>
@endsection

@section('content')
<section id="shop_banner" class="text-center" style="background: url('{{asset('frontend/images/shop.jpg')}}') no-repeat center/cover;">
    <div class="container">
        <h3>Contact</h3>
    </div>
</section>

<!-- ==================== contact area start =================== -->
<section id="contact_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <div class="contact_main">
                            <h2>Get in Touch</h2>
                            <h3>If You Want to Join Us</h3>
                            <div div class="left_item d-flex">
                                <div class="contact_icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="contact_text">
                                    <h4>Address :</h4>
                                    <p>{{$contact->address}}</p>
                                </div>
                            </div>
                            <div div class="left_item d-flex">
                                <div class="contact_icon">
                                    <i class="fa-solid fa-phone-volume"></i>
                                </div>
                                <div class="contact_text">
                                    <h4>Phone :</h4>
                                    <p>{{$contact->phone}}</p>
                                </div>
                            </div>
                            <div div class="left_item d-flex">
                                <div class="contact_icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact_text">
                                    <h4>E-mail :</h4>
                                    <p>{{$contact->email}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-form">
                            <form action="{{route('message.store')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name*</label>
                                    <input type="text" name="name" class="form-control">
                                    @error('name')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email*</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('email')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Message*</label>
                                    <textarea name="message" class="form-control" style="resize: none; height: 100px;"></textarea>
                                    @error('message')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit">Send Message</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== contact area end =================== -->
@endsection

@section('footer_script')
    <script>
           @if(Session::has('succ'))
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true,
            }
                    toastr.success("{!! session('succ') !!}");
            @endif
    </script>
@endsection