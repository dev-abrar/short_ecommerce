@extends('layouts.dashboard')

@section('content')
@can('product_list')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Product List</h3>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Preview</th>
                        </tr>
                        
                        @foreach ($products as $sl=>$product)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>&#2547;{{$product->price}}</td>
                                <td>
                                    <img width="100" src="{{asset('upload/product/preview')}}/{{$product->preview}}" alt="">
                                </td>
                                <td>
                                    <form action="{{route('product.inventory')}}" method="GET" class="d-inline">
                                        @csrf
                                        <button name="product_id" value="{{$product->id}}" class="btn btn-info"><i class="fa-regular fa-folder-open"></i></button>
                                    </form>

                                    <form action="{{route('product.edit')}}" method="GET" class="d-inline">
                                        @csrf
                                        <button name="product_id" value="{{$product->id}}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </form>

                                    <a href="{{route('product.delete', $product->id)}}" class="btn btn-danger"><i class="icon-trash"></i></a>
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