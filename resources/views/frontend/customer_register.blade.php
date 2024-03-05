@extends('frontend.master')
@section('meta_content')
<title>Customer Register</title>
@endsection

@section('content')
    <!-- ============================= register form start====================== -->
    <section id="simple-form">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-8 col-xl-6 m-auto">
                    <div class="user_form">
                        <div class="card-header">
                            <h3>Register Form</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('customer.store')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name *</label>
                                    <input type="text" name="name" class="form-control">
                                    @error('name')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('email')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Number *</label>
                                    <input type="number" name="phone" class="form-control">
                                    @error('phone')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password *</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="">Sign Up</button>
                                </div>
                                <div class="mt-5">
                                    <p>Already Have an Account ? <a href="{{route('customer.login')}}">Sign in</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================= register form end====================== -->
@endsection