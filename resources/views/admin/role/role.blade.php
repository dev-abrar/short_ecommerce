@extends('layouts.dashboard')

@section('content')
@can('role')
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white text-center">Add role permission</h3>
            </div>
            <div class="card-body">
                <form action="{{route('role.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Role Name</label>
                        <input type="text" name="role_name" class="form-control">
                        @error('role_name')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <h5 class="text-dark">Select Permission</h5>
                        <div class="form-group d-flex flex-wrap ">

                            @foreach ($permissions as $permission)
                            <div class="form-check mr-4">
                                <label class="form-check-label">
                                    <input type="checkbox" name="permission[]" class="form-check-input"
                                        value="{{$permission->name}}">
                                    {{$permission->name}}
                                    <i class="input-helper"></i></label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 m-auto">
                            <div class="mb-3">
                                <button class="btn bg-primary form-control text-white">Update Permission</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12
        mb-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white text-center">Role has Permission</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Role Name</th>
                        <th>Permission</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>
                            @foreach ($role->getPermissionNames() as $permission)
                            <div class="badge badge-primary mb-2">{{$permission}}</div>
                            @endforeach
                        </td>
                        <td>
                            <div class="dropdown mb-3">
                                <a href="javascript:void(0)" class="more-button" data-toggle="dropdown" aria-expanded="false">
                                   <i style="font-size: 24px;" class="icon-ellipsis text-dark"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <form action="{{route('role.edit')}}" method="GET" class="d-inline">
                                        <button name="role_id" value="{{$role->id}}" class="dropdown-item">Edit</button>
                                    </form>
                                    <a href="{{route('role.delete', $role->id)}}" class="dropdown-item">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>User Role</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>
                            @forelse ($user->getRoleNames(); as $role)
                            <div class="badge badge-primary">{{$role}}</div>
                            @empty
                            <div class="badge badge-success">Not Assigned</div>
                            @endforelse
                        </td>
                        <td>
                            <a href="{{route('remove.role', $user->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white text-center">Assign Role</h3>
            </div>
            <div class="card-body">
                <form action="{{route('assign.role')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>User name</label>
                        <select name="user_id" class="form-control">
                            <option value="">--select user--</option>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Role name</label>
                        <select name="role_id" class="form-control">
                            <option value="">--select user--</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Assign role</button>
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
