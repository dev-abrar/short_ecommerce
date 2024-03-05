@extends('layouts.dashboard')

@section('content')
@can('message_view')
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Message Info</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{$contacts->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$contacts->email}}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{$contacts->message}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
@endcan
@endsection