@extends('layouts.dashboard')

@section('content')
@can('order_details')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white text-center">Order Details</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{$order_info->rel_to_customer->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$order_info->rel_to_customer->email}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{$order_info->phone}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{$order_info->address}}</td>
                        </tr>
                        <tr>
                            <th>Charge</th>
                            <td>&#2547;{{$order_info->charge}}</td>
                        </tr>
                        <tr>
                            <th>Product Name</th>
                            <td>
                                @foreach (App\Models\OrderProduct::where('order_id', $order_info->order_id)->get(); as $product)
                                <h5><strong class="text-dark">{{$product->rel_to_product->product_name}}</strong> - SKU: {{$product->rel_to_product->sku}},</h5>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Product Image</th>
                            <td>
                                @foreach (App\Models\OrderProduct::where('order_id', $order_info->order_id)->get(); as $product)
                                <img style="width: 100px !important; height: 100px !important; object-fit; cover;" src="{{asset('upload/product/preview')}}/{{$product->rel_to_product->preview}}" alt="">
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>&#2547;{{$order_info->total}}</td>
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