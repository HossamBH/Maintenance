@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Create Car Maintenance')

@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Create New Maintenance</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.serviceMaintenance.store')}}" id="advanced-form"
                    data-parsley-validate novalidate>
                    @csrf
                    <div class="row text-danger">
                        {!! session()->get('error') !!}
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" class="form-control" style="width: 100%;" data-select2-id="1"
                                    tabindex="-1" aria-hidden="true" id="customer" required>
                                    <option value="">Choose Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="car_id">cars</label>
                                <select name="car_id" class="form-control" style="width: 100%;" data-select2-id="1"
                                    tabindex="-1" aria-hidden="true" id="car" required>
                                    <option value="">Choose Car</option>
                                </select>
                                @error('car_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="kms">Kilometers</label>
                            <input type="number" class="form-control"
                                placeholder="1000" name="kms"
                                value="{{old('kms')}}" id="kms"required>
                            @error('kms')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Services</h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table" id="table">
                                            <thead>
                                                <tr>
                                                    <th>ACTIONS</th>
                                                    <th>NAME</th>
                                                    <th>Cost</th>
                                                    <th>SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tbody id="append_services">
                                                <tr index=1>
                                                    <td><a style="float: right;pointer-events: none;"
                                                            class="btn btn-danger block"><i class="icon-ban"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control" name="service_id[]" id="service0"
                                                                class="item" onClick="handleChangeService(0)">
                                                                <option value="">Choose Service</option>
                                                                @foreach($services as $service)
                                                                <option value="{{$service->id}}">{{$service->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('service_id')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="Ex: 99,99 $" name="cost"
                                                                value="{{old('cost')}}" id="cost0">
                                                            @error('cost')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h6 id="SRsubtotal0">0.00</h6>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-2">
                                            <a class="btn btn-primary block" id="add_new_service" class="add_new_service"
                                                style="margin-left:59%;"><i class="icon-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:30%;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h6>Service Subtotal:</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p id="SRsubAllTotal" onChange="maintenance();">0.00 EG</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:30%;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h6>Service Tax:</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p id="SRallTax">0.00 EG</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:30%;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h6>Service Total:</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p id="SRtotal">0.00 EG</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Items</h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table" id="table">
                                            <thead>
                                                <tr>
                                                    <th>ACTIONS</th>
                                                    <th>NAME</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tbody id="append_items">
                                                <tr index=1>
                                                    <td><a style="float: right;pointer-events: none;"
                                                            class="btn btn-danger block"><i class="icon-ban"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control" name="item_id[]" id="item0"
                                                                class="item" onClick="handleChangeItem(0)">
                                                                <option value="">Choose Items</option>
                                                                @foreach($items as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('item_id')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" name="quantity[]" id="quantity0"
                                                                class="form-control" value=1
                                                                onChange="handleChangeQuantity(0)">
                                                            @error('quantity[]')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="Ex: 99,99 $" name="price"
                                                                value="{{old('price')}}" id="price0">
                                                            @error('price')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h6 id="subtotal0">0.00</h6>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-2">
                                            <a class="btn btn-primary block" id="add_new_item" class="add_new_item"
                                                style="margin-left:30%;"><i class="icon-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:30%;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h6>Items Subtotal:</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p id="subAllTotal">0.00 EG</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:30%;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h6>Items Tax:</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p id="allTax">0.00 EG</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:30%;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h6>Items Total:</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p id="total">0.00 EG</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Total Due Maintenance</h2>
                                </div>
                                <div class="body">
                                    <div class="row" style="margin-left:30%;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h6>Subtotal:</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p id="MsubAllTotal">0.00 EG</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:30%;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h6>Tax:</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p id="MallTax">0.00 EG</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:30%;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h6>Total:</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p id="Mtotal">0.00 EG</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Entrance Date</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control"
                                        name="entrance_date" data-date-format="yyyy-mm-dd" required
                                        value="{{old('entrance_date')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Delivery Date</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control"
                                        name="delivery_date" data-date-format="yyyy-mm-dd" required
                                        value="{{old('delivery_date')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="type_id">Duration</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar-times-o"></i></span>
                                    </div>
                                    <input type="number" class="form-control key" placeholder="1"
                                        name="duration" value="{{old('duration')}}" required>
                                </div>
                                @error('duration')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        <div class="form-group">
                        <label>Comments</label>
                        <textarea class="form-control" name="comments" rows="5" cols="30">{{old('comments')}}</textarea>
                      
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<style>
    .mul-select {
        width: 100%;
    }
</style>
@stop

@section('page-script')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>

<script>
    $(function() {

// validation needs name of the element
$('#food').multiselect();

// initialize after multiselect
$('#basic-form').parsley();
$(".mul-select").select2({
placeholder: "select Items", //placeholder
tags: true,
tokenSeparators: ['/',',',';'," "]
});

});

//
var i =1;
$('#add_new_service').on('click', function (event) {

$(this).data('clicked', true);

var append = '<tr index="'+i+'" id="'+i+'">';
append += '<td><a style="float: right;"class="btn btn-danger block add_item" onClick="Delete('+i+')"><i class="icon-trash"></i></a></td>';
append += '<td> <div class="form-group"><div class="form-group"><select class="form-control" name="item_id[]" onChange="handleChangeService('+i+')" id="service'+i+'"><option value="">Choose Service</option>'
@foreach($services as $service)
append+='<option value="{{$service->id}}">{{$service->name}}</option>'
@endforeach
append+='</select></div></div></td>';
append += '<td> <div class="form-group mt-3"><input type="text" class="form-control money-dollar" placeholder="Ex: 99,99 $" id="cost'+i+'" onChange="handelChangetotal('+i+')"><br></div></td>';
append += '<td><h6 id="SRsubtotal'+i+'" onChange="handelChangetotal('+i+')">0.00</h6></td>';
append += '</tr>';

$("#append_services").last().append(append);
i++;
console.log(i);

});




//
$('#add_new_item').on('click', function (event) {

$(this).data('clicked', true);

var append = '<tr index="'+i+'" id="'+i+'">';
append += '<td><a style="float: right;"class="btn btn-danger block add_item" onClick="Delete('+i+')"><i class="icon-trash"></i></a></td>';
append += '<td> <div class="form-group"><div class="form-group"><select class="form-control" name="item_id[]" onChange="handleChangeItem('+i+')" id="item'+i+'"><option value="">Choose Items</option>'
@foreach($items as $item)
append+='<option value="{{$item->id}}">{{$item->name}}</option>'
@endforeach
append+='</select></div></div></td>';
append += '<td><div class="form-group"><input type="number" name="quantity[]" id="quantity'+i+'" onChange="handleChangeQuantity('+i+')" class="form-control"value=1></div></td><td> <div class="form-group mt-3"><input type="text" class="form-control money-dollar" placeholder="Ex: 99,99 $" id="price'+i+'" onChange="handelChangetotal('+i+')"><br></div></td>';
append += '<td><h6 id="subtotal'+i+'" onChange="handelChangetotal('+i+')">0.00</h6></td>';
append += '</tr>';

$("#append_items").last().append(append);
i++;
console.log(i);

});
//
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
var invoice={};
var serviceinvoice={};

var index=0;
var handleChangeItem = function (i) {
var item= $('#item'+i+'').val();
var quantity= $('#quantity'+i+'').val();

invoice[i] = [item,quantity];

if (item) {
console.log(invoice);
var invoiceData = JSON.stringify(invoice);
console.log(JSON.stringify(invoice));
$.get("{{url('/getItem/')}}"+ '/' + item + '/' + quantity +'/'+invoiceData, function (data) {
if (data.length != 0) {
console.log(data);
$('#price'+i+'').val(data.item.price);
$('#subtotal'+i+'').text(data.subtotal);
$('#subAllTotal').text(data.subAllTotal);
$('#allTax').text(data.allTax);
$('#total').text(data.total);
$('#MsubAllTotal').text(data.subAllTotal);
$('#MallTax').text(data.allTax);
$('#Mtotal').text(data.total);
}
console.log(data);
}, "json");
}
}
///////service

var handleChangeService = function (i) {
var service= $('#service'+i+'').val();
serviceinvoice[i] = [service];

if (service) {
console.log(serviceinvoice);
var invoiceData = JSON.stringify(serviceinvoice);
console.log(JSON.stringify(serviceinvoice));
$.get("{{url('/getService/')}}"+ '/' + service + '/'+invoiceData, function (data) {
if (data.length != 0) {
console.log(data);
$('#cost'+i+'').val(data.service.cost);
$('#SRsubtotal'+i+'').text(data.subtotal);
$('#SRsubAllTotal').text(data.subAllTotal);
$('#SRallTax').text(data.allTax);
$('#SRtotal').text(data.total);
$('#MsubAllTotal').text(data.subAllTotal);
$('#MallTax').text(data.allTax);
$('#Mtotal').text(data.total);
}
console.log(data);
}, "json");
}
}
///////maintwnance
var maintenance = function (i) {
var Ssubtotal= $('#SRsubAllTotal').val();
alert('sub');
maintenance[i] = [Ssubtotal];

if (Ssubtotal) {
console.log(maintenance);
var invoiceData = JSON.stringify(maintenance);
console.log(JSON.stringify(maintenance));
$.get("{{url('/totalMaintenance/')}}"+ '/' + Ssubtotal + '/'+invoiceData, function (data) {
if (data.length != 0) {
console.log(data);
$('#MsubAllTotal').val(data.subtotal);
}
console.log(data);
}, "json");
}
}
///
var handleChangeQuantity = function (i) {
var quantity= $('#quantity'+i+'').val();
var item= $('#item'+i+'').val();

invoice[i] = [item,quantity];

if (quantity) {
var invoiceData = JSON.stringify(invoice);
console.log(JSON.stringify(invoice));
$.get("{{url('/getItem/')}}"+ '/' + item + '/' + quantity +'/'+invoiceData, function (data) {
if (data.length != 0) {
console.log(data);
$('#subtotal'+i+'').text(data.subtotal);
$('#subAllTotal').text(data.subAllTotal);
$('#allTax').text(data.allTax);
$('#total').text(data.total);
}
console.log(data);
}, "json");

}
}
//

//DElete Function
function Delete(i){
$('#'+i+'').remove();
}

</script>
<script>
    var config ={
 _url:"{{url('/customerCars/')}}"
}
</script>
<script src="{{ asset('assets/js/pages/customerCars.js') }}"></script>
@stop
