@extends('layouts.dashboard')

@section('content')
@can('message_list')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Message List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($messages as $sl=>$message)
                            <tr class="{{$message->status == 0?'bg-light':''}}">
                                <td>{{$sl+1}}</td>
                                <td>{{$message->name}}</td>
                                <td>{{$message->email}}</td>
                                <td>{{Substr($message->message, 0, 20)}}..more</td>
                                <td>
                                    <form action="{{route('message.view')}}" method="GET" class="d-inline">
                                        <button name="message_id" value="{{$message->id}}" class="btn btn-primary">View</button>
                                    </form>
                                    <a href="{{route('message.delete', $message->id)}}" class="btn btn-danger">Delete</a>
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