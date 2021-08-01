@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Create Car')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Create New Car</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.cars.store')}}" id="advanced-form" data-parsley-validate
                    novalidate>
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="tax_id" style="margin-left:40%;"><b>Customer</b></label>
                                <select name="customer_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                    <option value="">Choose Customer</option>

                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}"
                                        {{Request::segment(3)!='null'&& $customer->id==Request::segment(3)?'selected':''}}>
                                        {{$customer->name}}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tax_id">Brand</label>
                                <select name="brand_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required
                                    id="brand">
                                    <option value="">Choose Brand</option>

                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tax_id">Model</label>
                                <select name="model_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required
                                    id="model">
                                    <option value="">Choose Model</option>

                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tax_id">Car Type</label>
                                <select name="type" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                    <option value="">Choose Type</option>
                                    <option value="hatchback">Hatchback</option>
                                    <option value="suv">SUV</option>
                                    <option value="sedan">sedan</option>
                                </select>
                                @error('type')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tax_id">Car Year</label>
                                <select name="year" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                    <option value="">Choose Year</option>
                                    @foreach($years as $year)
                                    <option value="{{$year->year}}">{{$year->year}}</option>
                                    @endforeach
                                </select>
                                @error('year')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kms">KiloMeters</label>
                                <input type="number" class="form-control" placeholder="enter KM" name="kms"
                                    value="{{old('kms')}}" required><br>
                                @error('kms')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="motor_no">Motor Number</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    <input type="text" class="form-control key" placeholder="Ex:12388587745"
                                        name="motor_no" value="{{old('motor_no')}}" required>
                                </div>
                                @error('motor_no')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="license_number">License Number</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-drivers-license"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter License Number"
                                        name="license_number" value="{{old('license_number')}}" required>
                                </div>
                                @error('license_number')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" class="form-control" placeholder="Ex:red" name="color"
                                    value="{{old('color')}}" required>
                                @error('color')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Comments</label>
                                <textarea class="form-control" name="comments" rows="5"
                                    cols="30">{{old('comments')}}</textarea>
                                @error('comments')
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
    var config ={
    _url:"{{url('/get_Models/')}}"
    }
</script>
<script src="{{ asset('assets/js/pages/getModels.js') }}"></script>
<script>
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>
@stop
