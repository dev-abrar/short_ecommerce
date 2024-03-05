@extends('layouts.dashboard')

@section('content')
@can('edit_content3')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-center text-white">Edit Content-2 Info</h3>
                </div>
                @if (session('shop'))
                    <div class="alert alert-success">{{session('shop')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('content3.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="hidden" name="banner_id" value="{{$content->id}}">
                        <input type="text" name="title" class="form-control" value="{{$content->title}}">
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <input type="text" name="desp" class="form-control" value="{{$content->desp}}">
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('image')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        @if (session('photo_error'))
                            <strong class="text-danger">{{session('photo_error')}}</strong>
                        @endif
                        <div class="my-2">
                            <img width="100" id="blah" src="{{asset('upload/content3')}}/{{$content->image}}" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 m-auto">
                            <div class="mb-3">
                                <button class="btn bg-info text-white form-control" type="submit">Update</button>
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