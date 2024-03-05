@extends('layouts.dashboard')

@section('content')
@can('edit_footer')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white text-center">Edit Footer Info</h3>
                </div>
                @if (session('footer'))
                    <div class="alert alert-success">{{session('footer')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('footer.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Discription</label>
                                    <input type="hidden" name="footer_id" value="{{$footers->id}}">
                                    <input type="text" name="desp" class="form-control" value="{{$footers->desp}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{$footers->email}}">

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Phone Number</label>
                                    <input type="number" name="phone" class="form-control" value="{{$footers->phone}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Whatsapp Number</label>
                                    <input type="number" name="whatsapp" class="form-control" value="{{$footers->whatsapp}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Whatsapp Link</label>
                                    <input type="text" name="whatsapp_link" class="form-control" value="{{$footers->whatsapp_link}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" value="{{$footers->address}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Logo</label>
                                    <input type="file" name="image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                                @error('image')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                                @if (session('photo_error'))
                                    <strong class="text-danger">{{session('photo_error')}}</strong>
                                @endif
                                <div class="my-2">
                                    <img width="100" id="blah" src="{{asset('upload/footer')}}/{{$footers->image}}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 m-auto">
                                <div class="mb-3">
                                <button class="btn bg-info form-control text-white" type="submit">Update</button>
                               </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
@endcan
@endsection