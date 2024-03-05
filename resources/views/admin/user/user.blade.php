@extends('layouts.dashboard')

@section('content')
    @can('user_list')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>User List</h3>
                </div>
                @if (session('user_delete'))
                <div class="alert alert-success">{{session('user_delete')}}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($users as $sl=>$user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @can('user_action')
                                        <a href="{{route('user.delete', $user->id)}}" class="btn btn-danger">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        @can('user_create')
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Create User</h3>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('create.user') }}">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endcan
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
    @endcan
@endsection