@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Product Inventory</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    
                    @foreach ($inventories as $sl=>$inventory)
                        <tr>
                            <td>{{$sl+1}}</td>
                            <td>{{$inventory->rel_to_product->product_name}}</td>
                            <td>{{$inventory->quantity}}</td>
                            <td>
                                <a href="{{route('inventory.delete', $inventory->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add Inventory</h3>
            </div>
            @if (session('succ'))
                <div class="alert alert-success">{{session('succ')}}</div>
            @endif
            <div class="card-body">
                <form action="{{route('inventory.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Product Quantity</label>
                        <input type="hidden" value="{{$product_info->id}}" name="product_id">
                        <input type="number" class="form-control" name="quantity">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-info" type="submit">Add Inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection