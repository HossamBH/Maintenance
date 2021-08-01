@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Edit Payment')

@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Edit Payment</h2>
            </div>
            <div class="body">
                @if($errors->any())
                <div class="alert alert-danger text-center msg" id="error">
                    <h6>{{$errors->first()}}</h6>
                </div>
                @endif
                <form method="POST" action="{{route('admin.payments.update',['payment'=>$payment->id])}}"
                    id="advanced-form" data-parsley-validate novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="po_id">Purchase Order</label>
                                <input type="text" name="po_id" class="form-control" value="{{$payment->po_id}}"
                                    style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="po_id">Payment Type</label>
                                <select class="form-control" name="payment_type">
                                    @if($payment->payment_type == "cash")
                                    <option selected value="cash">Cash</option>
                                    <option value="visa">Visa</option>
                                    @else
                                    <option value="cash">Cash</option>
                                    <option selected value="visa">Visa</option>
                                    @endif
                                </select>
                            </div>
                            @error('payment_type')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="paid">Paid</label>
                                <input type="number" class="form-control" name="paid" placeholder="Enter Paid"
                                    value="{{old('paid', $payment->paid)}}">
                                @error('paid')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="file_attachment">Attachment</label>
                                    <input type="file" class="form-control" name="file_attachment"
                                        placeholder="Enter Attachment" value="{{old('file_attachment')}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div>
                                        <img src="{{$payment->file_attachment}}" width="300px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Comments</label>
                                <textarea class="form-control" name="comments" rows="5"
                                    cols="30">{{old('comments', $payment->comments)}}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
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
