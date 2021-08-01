@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Edit Salary')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Edit Salary</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.salaries.update',['salary'=>$salary->id])}}"
                    id="advanced-form" data-parsley-validate novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                <label for="emp_id">Employees</label>
                                <select name="emp_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                    <option value="">Choose Employee </option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}" {{$salary->emp_id==$employee->id?'selected':''}}>
                                        {{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type_id">Month</label>
                                <select name="month" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                    <option value="">Choose Month </option>
                                    <option value="January" {{$salary->month=='January'?'selected':''}}>January</option>
                                    <option value="Febuary" {{$salary->month=='Febuary'?'selected':''}}>Febuary</option>
                                    <option value="March" {{$salary->month=='March'?'selected':''}}>March</option>
                                    <option value="April" {{$salary->month=='April'?'selected':''}}>April</option>
                                    <option value="May" {{$salary->month=='May'?'selected':''}}>May</option>
                                    <option value="June" {{$salary->month=='June'?'selected':''}}>June</option>
                                    <option value="July" {{$salary->month=='July'?'selected':''}}>July</option>
                                    <option value="August" {{$salary->month=='August'?'selected':''}}>August</option>
                                    <option value="September" {{$salary->month=='September'?'selected':''}}>September
                                    </option>
                                    <option value="October" {{$salary->month=='October'?'selected':''}}>October</option>
                                    <option value="November" {{$salary->month=='November'?'selected':''}}>November
                                    </option>
                                    <option value="December" {{$salary->month=='December'?'selected':''}}>December
                                    </option>
                                </select>
                                @error('month')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="salary_date">Salary Date</label>
                                <div class="input-group mb-3">
                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control"
                                        name="salary_date" data-date-format="yyyy-mm-dd" required
                                        value="{{$salary->salary_date}}">
                                </div>
                                @error('salary_date')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type_id">bonus</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    </div>
                                    <input type="number" class="form-control key" name="bonus"
                                        value="{{$salary->bonus}}">
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="deduction">deduction</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    </div>
                                    <input type="number" class="form-control key" name="deduction"
                                        value="{{$salary->deduction}}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>comments</label>
                                <textarea class="form-control" name="comments" rows="5"
                                    cols="30">{{$salary->comments}}</textarea>
                                @error('comments')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary mx-auto">Update</button>
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
