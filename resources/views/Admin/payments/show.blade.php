@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Show Payment')

@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Show Payment</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="po_id">Purchase Order</label>
                            <input disabled type="text" name="po_id" class="form-control" value="{{$payment->po_id}}"
                                style="width: 100%;">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="payment_type">Payment Type</label>
                            <input disabled type="text" name="payment_type" class="form-control"
                                value="{{$payment->payment_type}}" style="width: 100%;">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="paid">Paid</label>
                            <input disabled type="text" name="paid" class="form-control" value="{{$payment->paid}}"
                                style="width: 100%;">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="file_attachment">Attachment</label>
                            <div>
                                <img src="{{$payment->file_attachment}}" width="300px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Comments</label>
                            <textarea disabled class="form-control" name="comments" rows="5"
                                cols="30">{{($payment->comments)}}</textarea>
                        </div>
                    </div>
                </div>
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
