@extends('layouts.dashboard')

@section('content')
@can('edit_about')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Edit about Information</h3>
                </div>
                @if (session('about'))
                    <div class="alert alert-success">{{session('about')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('about.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>SEO Title</label>
                            <textarea name="seo_title" class="form-control">{{$about->seo_title}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Title-1</label>
                            <input type="hidden" name="about_id" value="{{$about->id}}">
                            <input type="text" class="form-control" name="title1" value="{{$about->title1}}">
                        </div>
                        <div class="mb-3">
                            <label>Decription-1</label>
                            <textarea name="desp1" class="form-control">{{$about->desp1}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Title-2</label>
                            <input type="text" class="form-control" name="title2" value="{{$about->title2}}">
                        </div>
                        <div class="mb-3">
                            <label>Decription-2</label>
                            <textarea name="desp2" class="form-control">{{$about->desp2}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Title-3</label>
                            <input type="text" class="form-control" name="title3" value="{{$about->title3}}">
                        </div>
                        <div class="mb-3">
                            <label>Decription-3</label>
                            <textarea name="desp3" class="form-control">{{$about->desp3}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Title-4</label>
                            <input type="text" class="form-control" name="title4" value="{{$about->title4}}">
                        </div>
                        <div class="mb-3">
                            <label>Decription-4</label>
                            <textarea name="desp4" class="form-control">{{$about->desp4}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            @error('image')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('photo_error'))
                            <strong class="text-danger">{{session('photo_error')}}</strong>
                            @endif
                            <div class="my-2">
                                <img width="100" id="blah" src="{{asset('upload/about')}}/{{$about->image}}" alt="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 m-auto">
                                <div class="mb-3">
                                    <button class="btn form-control bg-primary text-white">Update</button>
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