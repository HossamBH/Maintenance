@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Edit Type')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Edit Type</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.expensesType.update', ['expensesType' => $type->id])}}"
                    id="advanced-form" data-parsley-validate novalidate>
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="text-input1"> Name</label>
                        <input type="text" id="text-input1" class="form-control" required name="name"
                            value="{{$type->name}}">
                        @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Edit</button>
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
