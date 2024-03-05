@extends('layouts.dashboard')

@section('content')
@can('privacy')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Privacy Policy</h3>
                </div>
                @if (session('succ'))
                    <div class="alert alert-success">{{session('succ')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('privacy.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Privacy Policy</label>
                            <input type="hidden" name="policy_id" value="{{$privacies->id}}">
                            <textarea name="desp" id="summernote">{{$privacies->desp}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 m-auto">
                                <div class="mb-3">
                                    <button class="btn form-control text-white bg-primary" type="submit">Update Policy</button>
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