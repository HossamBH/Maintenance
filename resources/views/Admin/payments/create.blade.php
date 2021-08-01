@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Create Payment')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Create New Payment</h2>
            </div>
            <div class="body">
                @if($errors->any())
                <div class="alert alert-danger text-center msg" id="error">
                    <h6>{{$errors->first()}}</h6>
                </div>
                @endif
                <form method="POST" enctype="multipart/form-data" action="{{route('admin.payments.store')}}"
                    id="advanced-form" data-parsley-validate novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="po_id">Purchase Order</label>
                                <select name="po_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="">Choose Purchase Order</option>

                                    @foreach($purchaseOrders as $purchaseOrder)
                                    <option value="{{$purchaseOrder->id}}">{{$purchaseOrder->id}}</option>
                                    @endforeach
                                </select>
                                @error('po_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="po_id">Payment Type</label>
                                <select class="form-control" name="payment_type">
                                    <option value="">Choose Payment Type</option>
                                    <option value="cash">Cash</option>
                                    <option value="visa">Visa</option>
                                </select>
                            </div>
                            @error('payment_type')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="paid">Paid</label>
                                <input type="number" class="form-control" name="paid" placeholder="Enter Paid"
                                    value="{{old('paid')}}">
                                @error('paid')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="file_attachment">Attachment</label>
                                <input type="file" class="form-control" name="file_attachment"
                                    placeholder="Enter Attachment" value="{{old('file_attachment')}}">
                                @error('file_attachment')
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
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
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
