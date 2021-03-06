@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Edit Customer')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Edit Customer</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.customers.update',['customer'=>$customer->id])}}"
                    id="advanced-form" data-parsley-validate novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="type_id">Customer Name</label>
                                <input type="text" class="form-control" placeholder="enter Customer Name" name="name"
                                    value="{{$customer->name}}"><br>
                                @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-at"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Ex: example@example.com"
                                        name="email" value="{{$customer->email}}"><br>
                                </div>
                                @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="type_id">Mobile</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control key" placeholder="Ex: 01234567890"
                                        name="mobile" value="{{$customer->mobile}}">
                                </div>
                                @error('mobile')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tax_id">City</label>
                                <select name="city_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" id="city">
                                    <option value="">Choose City</option>

                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{$customer->city_id==$city->id?'selected':''}}>
                                        {{$city->name_en}}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tax_id">Area</label>
                                <select name="area_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" id="area">
                                    <option value="">Choose Area</option>
                                    @foreach($areas as $area)
                                    <option value="{{$area->id}}" {{$customer->area_id==$area->id?'selected':''}}>
                                        {{$area->name_en}}</option>
                                    @endforeach
                                </select>
                                @error('area_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address" rows="5"
                                    cols="30">{{$customer->address}}</textarea>
                                @error('address')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-sm-center mb-5">
                        <a href="{{url("/cars/insert/{$customer->id}")}}"
                            class="btn btn-success btn-lg"><i class="fa fa-plus"></i>Add Car</a>
                    </div>

<div class="row justify-content-md-center">
    <button type="submit" class="btn btn-primary mx-auto">Edit</button>
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
    var config ={
    _url:"{{url('/get_areas/')}}"
    }
</script>
<script src="{{ asset('assets/js/pages/getAreas.js') }}"></script>

<script>
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>
@stop
