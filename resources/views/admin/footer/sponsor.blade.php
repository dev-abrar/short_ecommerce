@extends('layouts.dashboard')

@section('content')
@can('sponsors_image')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Footer Images List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($foot_imgs as $key=>$img)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <img  width="60" src="{{asset('upload/footer')}}/{{$img->foot_img}}" alt="">
                                </td>
                                <td>{{$img->foot_img_link}}</td>
                                <td>
                                    <a href="{{route('foot.img.delete', $img->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add footer image</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('footer.img.store')}}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="mb-3">
                        <label>Image</label>
                        <input type="file" class="form-control" name="foot_img">
                        <br>
                        @error('foot_img')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        @if (session('photo_error'))
                            <strong class="text-danger">{{session('photo_error')}}</strong>
                        @endif
                     </div>
                     <div class="mb-3">
                        <label>Link</label>
                        <input type="text" class="form-control" name="foot_img_link">
                        @error('foot_img_link')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Add Image</button>
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