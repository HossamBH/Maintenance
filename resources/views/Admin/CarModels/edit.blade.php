@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Create Brand')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Create New Brand</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.carModels.update',['carModel'=>$carModel->id])}}" id="advanced-form"
                    data-parsley-validate novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <b>Model Name</b>
                            <input type="text" class="form-control mt-2" placeholder="Enter Model Name" name="name" value="{{$carModel->name}}">
                                @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="">Choose Brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}"{{$carModel->brand_id==$brand->id?'selected':''}}>{{$brand->name}}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-primary mx-auto">Create</button>
                    </div>
                            
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/parsleyjs/css/parsley.css') }}">
@stop

@section('page-script')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script>
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>

@stop
