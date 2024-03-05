@extends('layouts.dashboard')

@section('content')
@can('subscription')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Subscription List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($Subscribes as $sl=>$sub )
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$sub->email}}</td>
                                <td>
                                    <a href="{{route('sub.delete', $sub->id)}}" class="btn btn-danger">Delete</a>
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