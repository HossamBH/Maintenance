@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Show Customer')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Show Customer</h2>
            </div>
            <section>
                <div class="body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="type_id">Customer Name</label>
                                <input type="text" class="form-control" placeholder="enter Customer Name" readonly
                                    name="name" value="{{$customer->name}}"><br>
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
                                    <input type="text" readonly class="form-control"
                                        placeholder="Ex: example@example.com" name="email"
                                        value="{{$customer->email}}"><br>
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
                                    <input type="text" readonly class="form-control key" placeholder="Ex: 01234567890"
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
                                <select name="city_id" readonly class="form-control select2 select2-hidden-accessible"
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
                                <select name="area_id" readonly class="form-control select2 select2-hidden-accessible"
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
                                <textarea class="form-control" readonly name="address" rows="5"
                                    cols="30">{{$customer->address}}</textarea>
                                @error('address')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
            </section>
            <section>
                <div class="body">
                    <div class="row">
                        <div>
                            <h6 class="header">Customer Cars</h6>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($cars as $car)
                        <div class="card-body">
                            <div class="body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="brand_id">Brand</label>
                                            <select readonly name="brand_id"
                                                class="form-control select2 select2-hidden-accessible"
                                                style="width: 100%;" data-select2-id="1" tabindex="-1"
                                                aria-hidden="true">
                                                <option value="">Choose Brand</option>

                                                @foreach($brands as $brand)
                                                <option value="{{$brand->id}}"
                                                    {{$car->car_model->car_brand->id==$brand->id?'selected':''}}>
                                                    {{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="model_id">Model</label>
                                            <select readonly name="model_id"
                                                class="form-control select2 select2-hidden-accessible"
                                                style="width: 100%;" data-select2-id="1" tabindex="-1"
                                                aria-hidden="true" required id="model">
                                                <option value="">Choose Model</option>
                                                @foreach($models as $model)
                                                <option value="{{$model->id}}"
                                                    {{$car->model_id==$model->id?'selected':''}}>{{$model->name}}
                                                </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="type">Car Type</label>
                                            <select readonly name="type"
                                                class="form-control select2 select2-hidden-accessible"
                                                style="width: 100%;" data-select2-id="1" tabindex="-1"
                                                aria-hidden="true" required>
                                                <option value="">Choose Type</option>
                                                <option value="hatchback" {{$car->type=='hatchback'?'selected':''}}>
                                                    Hatchback</option>
                                                <option value="suv" {{$car->type=='suv'?'selected':''}}>SUV</option>
                                                <option value="sedan" {{$car->type=='sedan'?'selected':''}}>sedan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="year">Car Year</label>
                                            <select readonly name="year"
                                                class="form-control select2 select2-hidden-accessible"
                                                style="width: 100%;" data-select2-id="1" tabindex="-1"
                                                aria-hidden="true" required>
                                                <option selected value="{{$car->year}}">{{$car->year}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="kms">KiloMeters</label>
                                            <input readonly type="number" class="form-control" placeholder="enter KM"
                                                name="kms" value="{{$car->kms}}" required><br>
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
                                                <input readonly type="text" class="form-control key"
                                                    placeholder="Ex:12388587745" name="motor_no"
                                                    value="{{$car->motor_no}}" required>
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
                                                    <span class="input-group-text"><i
                                                            class="fa fa-drivers-license"></i></span>
                                                </div>
                                                <input readonly type="text" class="form-control"
                                                    placeholder="Enter License Number" name="license_number"
                                                    value="{{$car->license_number}}" required>
                                            </div>
                                            @error('license_number')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="color">Color</label>
                                            <input readonly type="text" class="form-control" placeholder="Ex:red"
                                                name="color" value="{{$car->color}}" required>
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
                                            <textarea readonly class="form-control" name="comments" rows="5"
                                                cols="30">{{isset($car->comments)?$car->comments:''}}</textarea>
                                            @error('comments')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
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
