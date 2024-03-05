@extends('frontend.master')
@section('meta_content')
<title>Customer Login</title>
@endsection

@section('content')
      <!-- ============================= login form start====================== -->
      <section id="simple-form">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-8 col-xl-6 m-auto">
                    <div class="user_form">
                        <div class="card-header">
                            <h3>Login Form</h3>
                        </div>
                        @if (session('wrong'))
                            <div class="alert alert-danger">{{session('wrong')}}</div>
                        @endif
                        @if (session('login'))
                            <div class="alert alert-danger">{{session('login')}}</div>
                        @endif
                        <div class="card-body">
                            <form action="{{route('customer.signin')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('email')
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
                                    <button type="submit">Sign In</button>
                                </div>
                                <div class="mt-5">
                                    <p>Not a Member ? <a href="{{route('customer.register')}}">Singup</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================= login form end====================== -->
@endsection