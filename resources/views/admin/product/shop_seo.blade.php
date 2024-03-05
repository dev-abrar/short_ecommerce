@extends('layouts.dashboard')

@section('content')
@can('shop_seo')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Edit Shop Details</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('seo.shop.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>SEO Title</label>
                            <input type="hidden" name="shop_id" value="{{$shop->id}}">
                            <input type="text" class="form-control" name="title" value="{{$shop->title}}">
                        </div>
                        <div class="mb-3">
                            <label>SEO Description</label>
                            <textarea name="desp" class="form-control">{{$shop->desp}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>SEO Image</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        @if (session('photo_error'))
                            <strong class="text-danger">{{session('photo_error')}}</strong>
                        @endif
                        <div class="my-2">
                            <img width="100" id="blah" src="{{asset('upload/shop')}}/{{$shop->image}}" alt="">
                        </div>
                        </div>
                        <div class="row">
                            <div class="colg-lg-4 m-auto">
                                <button class="btn bg-primary text-white form-control">Update</button>
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