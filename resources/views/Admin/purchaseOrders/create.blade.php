@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Create Purchase Order')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Create New order</h2>
            </div>
            <div class="body">
            <form method="POST" action="{{route('admin.purchaseOrders.store')}}" id="advanced-form" data-parsley-validate novalidate>
                @csrf
                <div class="row">
                    <div class="col-4">
                    <div class="form-group">
                    <label for="supplier_id">Supplier Company Name</label>
                    <select name="supplier_id" class="form-control" style="width: 100%;"
                    data-select2-id="1" tabindex="-1" aria-hidden="true" id="category">
                    @foreach($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->company_name}}</option>
                    @endforeach
                    </select>
                    @error('supplier_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    </div>
                    
                    <div class="col-4">
                    <div class="form-group">
                    <label for="inventory_id">Inventory Name</label>
                    <select name="inventory_id" class="form-control" style="width: 100%;"
                    data-select2-id="1" tabindex="-1" aria-hidden="true" id="category">
                    @foreach($inventories as $inventory)
                    <option value="{{$inventory->id}}">
                   {{$inventory->name}}
                    </option>
                    @endforeach
                    </select>
                    @error('inventory_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                        </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="payment_type">Patyment Type</label>
                                <select name="payment_type" class="form-control" style="width: 100%;" data-select2-id="1"
                                    tabindex="-1" aria-hidden="true" id="payment_type">
                                    <option value="">Choose Payment Type</option>
                                    <option value="cash">Cash</option>
                                    <option value="visa">Visa</option>
                                </select>
                                @error('payment_type')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
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
                                                <th>Cost</th>
                                                <th>SubTotal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="append_items">
                                            <tr index=1>
                                                <td><a style="float: right;pointer-events: none;" class="btn btn-danger block"><i class="icon-ban"></i></a></td>
                                                <td> <div class="form-group">
                                                <div class="form-group">
                                                <select class="form-control" name="item_id[]" id="item0"class="item">
                                                <option value="">Choose Items</option>
                                                @foreach($items as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach 
                                                </select>
                                                </div> 
                                                @error('item_id')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                                </div></td>
                                                
                                                <td>
                                                <div class="form-group">
                                                <input type="number" name="quantity[]" id="quantity0"class="form-control" value=1 onChange="handleChangeQuantity(0)">
                                                </div> </td>
                                                <td> 
                                                <div class="form-group mt-3">
                                                <input type="number" class="form-control" placeholder="Ex: 99,99 $"
                                                name="cost[]" value="{{old('cost')}}" id="cost0" onChange="handleChangeCost(0)"><br>
                                                @error('cost')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                                </div></td>
                                                <td>
                                                <h6 id="subtotal0">0.00</h6>
                                                </td>
                                                </tr>
                                          
                                        </tbody>
                                    </table>
                                </div>
                                  <div class="row mb-5">
                                      <div class="col-2">
                                        <a  class="btn btn-primary block"
                                        id="add_new_item" class="add_new_item"style="margin-left:30%;"><i class="icon-plus"></i></a>
                                      </div>
                                  </div>
                              
                                <div class="row" style="margin-left:30%;">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <h6>Total:</h6>
                                        </div>
                                 </div>
                                 <div class="col-4">
                                     <p id="AllTotal">0.00 EG</p>
                                 </div>
                                </div>
                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                    <div class="form-group">
                    <label>Paid</label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                    </div>
                    <input type="number" class="form-control key" name="paid" onChange="handleChangeRemaining()" value="{{old('paid')}}" id="paid" required>
                    </div>
                    @error('paid')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="form-group">
                    <label>Remaining</label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                    </div>
                    <input type="number" class="form-control key" name="remaining" id="remaining" value="{{old('remaining')}}" disabled>
                    </div>
                    @error('remaining')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-8 mx-auto">
                    <div class="form-group">
                    <label>Due Date:</label>
                    <div class="input-group mb-3">
                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="expected_on" data-date-format="yyyy-mm-dd" required value="{{old('start_date')}}">
                    </div>
                    </div>
                    </div>
                    
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="file" class="dropify" name="file_attachment">
                            <div class="mt-3"></div>
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
                    
      
                
             
                    <button type="submit" class="btn btn-primary mx-auto">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/parsleyjs/css/parsley.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<style>
            .mul-select{
            width: 100%;
        }
</style>
@stop

@section('page-script')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
<script src="{{ asset('assets/vendor/dropify/js/dropify.min.js') }}"></script>

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/forms/dropify.js') }}"></script>

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

    $('#add_new_item').on('click', function (event) {

        $(this).data('clicked', true);

      
        var append = '<tr index="'+i+'" id="'+i+'">';
            append += '<td><a style="float: right;"class="btn btn-danger block add_item" onClick="Delete('+i+')"><i class="icon-trash"></i></a></td>';
            append += '<td> <div class="form-group"><div class="form-group"><select class="form-control" name="item_id[]" id="item'+i+'"><option value="">Choose Items</option>'
            @foreach($items as $item)
            append+='<option value="{{$item->id}}">{{$item->name}}</option>'
            @endforeach
            append+='</select></div></div></td>';
            append += '<td><div class="form-group"><input type="number" name="quantity[]" id="quantity'+i+'" onChange="handleChangeQuantity('+i+')" class="form-control"value=1></div></td><td> <div class="form-group mt-3"><input type="number" class="form-control money-dollar" placeholder="Ex: 99,99 $" id="cost'+i+'" name="cost[]" onChange="handleChangeCost('+i+')"><br></div></td>';
            append += '<td><h6 id="subtotal'+i+'">0.00</h6></td>'; 
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
    var index=0;
    
    var handleChangeCost = function (i) {   
        var cost= $('#cost'+i+'').val();
        var quantity= $('#quantity'+i+'').val();

        invoice[i] = [cost,quantity];

        if (cost) {
            console.log(invoice);
            var invoiceData = JSON.stringify(invoice);
            console.log(JSON.stringify(invoice));
            $.get("{{url('/total/')}}"+'/'+cost + '/' + quantity +'/'+invoiceData, function (data) {
                if (data.length != 0) {
                console.log(data);
                $('#subtotal'+i+'').text(data.subtotal);
                $('#AllTotal').text(data.subAllTotal);
                }
                console.log(data);
            }, "json");
        }
    }
///
    var handleChangeQuantity  = function (i) {
        var quantity= $('#quantity'+i+'').val();
        var cost= $('#cost'+i+'').val();

        invoice[i] = [cost,quantity];

        if (quantity) {
            var invoiceData = JSON.stringify(invoice);
            console.log(JSON.stringify(invoice));
            $.get("{{url('/total/')}}"+'/'+cost + '/' + quantity +'/'+invoiceData, function (data)  {
            if (data.length != 0) {
                console.log(data);
                $('#subtotal'+i+'').text(data.subtotal);
                $('#AllTotal').text(data.subAllTotal);
                
            }
                console.log(data);
            }, "json");

        }
    }
   //
var handleChangeRemaining =function(){
    var paid=$('#paid').val();
    var AllTotal=$('#AllTotal').text();
    if (paid) {
            $.get("{{url('/remaining/')}}"+'/'+paid + '/' + AllTotal, function (data)  {
            if (data.length != 0) {
                console.log(data);
                $('#remaining').val(data.remaining);
                
            }
                console.log(data);
            }, "json");

        }

}
//DElete Function
function Delete(i){
    $('#'+i+'').remove();
    
}

    
</script>
<script>
    var config ={
    _url:"{{url('/getItem/')}}"
    }
</script>
<script src="{{ asset('assets/js/pages/item.js') }}"></script>
@stop