@extends('layouts.dashboard')

@section('content')
@can('customer_list')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Customer List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Number</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($customers as $sl=>$user)
                    <tr>
                        <td>{{$sl+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>
                            <a href="{{route('customer.delete', $user->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
@endcan
@endsection
