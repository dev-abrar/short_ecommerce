@extends('layouts.dashboard')

@section('content')
@can('order_list')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Order List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Order ID</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->order_id}}</td>
                                <td>&#2547;{{$order->total}}</td>
                                <td>{{$order->created_at->format('d-M-Y')}}</td>
                                <td>
                                    <form action="{{route('order.details')}}" method="GET">
                                        @csrf
                                        <button name="order_id" value="{{$order->id}}" class="btn btn-primary">Order Details</button>
                                    </form>
                                </td>
                                <td>
                                    @php
                                        if($order->status == 0){
                                            echo '<span class="badge badge-info">Placed</span>';
                                        }
                                        elseif ($order->status == 1) {
                                            echo '<span class="badge badge-info">Processing</span>';
                                        }
                                        elseif ($order->status == 2) {
                                            echo '<span class="badge badge-info">Pick UP</span>';
                                        }
                                        elseif ($order->status == 3) {
                                            echo '<span class="badge badge-info">Ready to Deliver</span>';
                                        }
                                        else{
                                            echo '<span class="badge badge-info">Delivered</span>';
                                        }
                                    @endphp
                                </td>
                                <td class="d-flex justify-content-between">
                                    <div class="dropdown mb-3">
                                        <a href="javascript:void(0)" class="more-button" data-toggle="dropdown" aria-expanded="false">
                                           <i style="font-size: 24px;" class="icon-ellipsis text-dark"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form action="{{route('order.status')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            <button value="0" class="dropdown-item" name="status">Placed</button>
                                            <button value="1" class="dropdown-item" name="status">Processing</button>
                                            <button value="2" class="dropdown-item" name="status">Pick UP</button>
                                            <button value="3" class="dropdown-item" name="status">Ready To Deliver</button>
                                            <button value="4" class="dropdown-item" name="status">Delivered</button>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
@endcan
@endsection