@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Add Employee')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Add New Employee</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.employees.store')}}" id="advanced-form" data-parsley-validate
                    novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <b>Employee Name</b>


                                <input type="text" class="form-control" placeholder="enter Employee Name" name="name"
                                    value="{{old('name')}}" required><br>

                                @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="job_id">Job</label>
                                <select name="job_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                    <option value="">Choose Position</option>

                                    @foreach($jobs as $job)
                                    <option value="{{$job->id}}">{{$job->position}}</option>
                                    @endforeach
                                </select>
                                @error('job_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <b>Employee Salary</b>
                                <input type="text" class="form-control" placeholder="Enter Salary" name="salary"
                                    required value="{{old('salary')}}"><br>
                                @error('salary')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Start Date</label>
                                <div class="input-group mb-3">
                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control"
                                        name="start_date" data-date-format="yyyy-mm-dd" required
                                        value="{{old('start_date')}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Add</button>
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
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

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
