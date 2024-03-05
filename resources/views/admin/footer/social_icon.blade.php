@extends('layouts.dashboard')

@section('content')
@can('social_icon')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Icon List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Icon</th>
                        <th>Icon Link</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($icons as $sl=>$icon)
                        <tr>
                            <td>{{$sl+1}}</td>
                            <td>
                                <i style="font-size: 24px; margin-right: 10px; color: red;" class="{{$icon->icon}}"></i>
                            </td>
                            <td>{{$icon->icon_link}}</td>
                            <td>
                                <div class="dropdown mb-3">
                                    <a href="javascript:void(0)" class="more-button" data-toggle="dropdown" aria-expanded="false">
                                       <i style="font-size: 24px;" class="icon-ellipsis text-dark"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('footer.icon.edit', $icon->id)}}" class="dropdown-item">Edit</a>
                                        <a href="{{route('footer.icon.delete', $icon->id)}}" class="dropdown-item">Delete</a>
                                    </div>
                                </div>
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
                <h4>Add Social Icon</h4>
            </div>
            <div class="card-body">
                @php
                    $fonts = array(
                        'fa-brands fa-facebook-f',
                        'fa-brands fa-twitter',
                        'fa-brands fa-linkedin',
                        'fa-brands fa-instagram',
                        'fa-brands fa-pinterest-p',
                        'fa-brands fa-youtube',
                        'fa-solid fa-basketball',
                        'fa-brands fa-behance',
                    );       
                @endphp
                
                <form action="{{route('footer.icon.store')}}" method="POST">
                    @csrf
                    @if (session('icon'))
                            <div class="alert alert-success">{{session('icon')}}</div>
                    @endif
                    <div class="mb-3">
                        @foreach ($fonts as $font)
                            <i style="font-size: 24px; margin-right: 10px; color: red; cursor: pointer;" class="{{$font}} fa"></i>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <label>Select Icon</label>
                        <input type="text" class="form-control" name="icon" id="icon">
                        @error('icon')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Icon Link</label>
                        <input type="text" name="icon_link" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Add Icon</button>
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

@section('footer_script')
<script>
    $('.fa').click(function(){
        var icon = $(this).attr('class');
        $('#icon').attr('value', icon);
    });
    </script>
@endsection