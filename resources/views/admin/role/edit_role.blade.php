@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white text-center">Add role permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('role.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Role Name</label>
                            <input type="hidden" name="role_id" value="{{$role->id}}">
                            <input type="text" name="role_name" class="form-control" value="{{$role->name}}">
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
                                            value="{{$permission->name}}" {{in_array($permission->id, $data)?'checked':''}}>
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
    </div>
@endsection