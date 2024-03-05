@extends('layouts.dashboard')

@section('content')
@can('add_product')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Add Product</h3>
                </div>
                @if (session('product'))
                    <div class="alert alert-success">{{session('product')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" name="product_name">
                                    @error('product_name')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Product Price</label>
                                    <input type="text" class="form-control" name="price">
                                    @error('price')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Short Description</label>
                                    <textarea name="short_desp" class="form-control"></textarea>
                                    @error('short_desp')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Long Description</label>
                                    <textarea name="long_desp" id="summernote"></textarea>
                                    @error('long_desp')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Preview Image</label>
                                    <input type="file" class="form-control" name="preview">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Gallery Image</label>
                                    <input type="file" multiple class="form-control" name="gallery[]">
                                </div>
                            </div>
                            <div class="col-lg-4 m-auto">
                                <div class="mb-3">
                                    <button class="btn bg-primary text-white form-control">Add Product</button>
                                </div>
                            </div>
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
@section('footer_script')
<script>
    $('#summernote').summernote();
</script>
@endsection