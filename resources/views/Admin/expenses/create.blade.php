@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Create Expense')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Create New expense</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.expenses.store')}}" id="advanced-form" enctype="multipart/form-data" data-parsley-validate
                    novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="tax_id">Type</label>
                                <select name="type_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                    <option value="">Choose Type</option>

                                    @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    </div>
                                    <input type="text" class="form-control money-dollar" placeholder="Ex: 99,99 $"
                                        name="total_amount" value="{{old('total_amount')}}" required>
                                </div>
                                @error('total_amount')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="tax_id">Payment Type</label>
                                <select name="payment_type" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                    <option value="">Choose Payment</option>
                                    <option value="cash">Cash</option>
                                    <option value="Visa">Visa</option>
                                </select>
                                @error('payment_type')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type_id">User Name</label>
                            <input type="text" class="form-control" value="{{auth()->user()->name}}" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type_id">Date</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control key"
                                         value="{{ Carbon\Carbon::now()->format('Y-m-d')}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Comments</label>
                                <textarea class="form-control" name="comments" rows="5" cols="30"
                                    required>{{old('comments')}}</textarea>
                            </div>
                        </div>
                    </div>
                 <div class="row">
                    <div class="col-12">
                        <input type="file" class="dropify" name="file_attachment">
                        <div class="mt-3"></div>
                    </div>  
                 </div>
        <div class="row justify-content-lg-center">
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
<link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">
@stop

@section('page-script')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
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
});
</script>
@stop
