@extends('layouts.dashboard')

@section('content')
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
                    <form action="{{route('product.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="hidden" name="product_id" value="{{$products->id}}">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" name="product_name" value="{{$products->product_name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Product Price</label>
                                    <input type="number" class="form-control" name="price" value="{{$products->price}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Short Description</label>
                                    <textarea name="short_desp" class="form-control">{{$products->short_desp}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Long Description</label>
                                    <textarea name="long_desp" id="summernote">
                                        {{$products->long_desp}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Preview Image</label>
                                    <input type="file" class="form-control" name="preview">
                                    <div class="mb-3">
                                        <img width="100" src="{{asset('upload/product/preview')}}/{{$products->preview}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Gallery Image</label>
                                    <input type="file" multiple class="form-control" name="gallery[]">
                                    <div class="mb-3">
                                        @foreach ($gallery as $gal)
                                        <img width="100" src="{{asset('upload/product/gallery')}}/{{$gal->gallery}}" alt="">
                                        @endforeach
                                    </div>
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
@endsection
@section('footer_script')
<script>
    $('#summernote').summernote();
</script>
@endsection