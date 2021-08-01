@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'employees')


@section('content')
<div class="row justify-content-end">
    <div class="col-3">
        <a class="btn btn-round btn-primary buttons-html5"href="{{url('employees/create')}}">
            <span>Add New Employee</span>
        </a>
    </div>
  
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                
        
            </div>
            <div class="body">
                <div class="table-responsive">
                    
                    <table class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th> Position</th>
                                <th> Salary</th>
                                <th>Start Date</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                      
                        <tbody>
                            @foreach ($employees as $employee)
                                
                      
                            <tr>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->job->position}}</td>
                            <td>{{$employee->salary}}</td>
                            <td>{{$employee->start_date}}</td>
                                <td><a href="{{url("/employees/{$employee->id}/edit")}}"
                                    class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    <form action="{{url("/employees/{$employee->id}")}}" method="post">
                                     <button class="btn btn-danger btn-xs confirm-del"><i
                                        class="fa fa-trash-o"></i></button>
                                                @method('DELETE')
                                                @csrf
                                 </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}"/>
<style>
    td.details-control {
    background: url('../assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('../assets/images/details_close.png') no-repeat center center;
    }
</style>
@stop

@section('page-script')
<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop