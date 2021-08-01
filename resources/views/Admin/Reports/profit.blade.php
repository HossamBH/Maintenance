@extends('layout.master')
@section('parentPageTitle', 'Profits')
@section('title', 'Profits Details')


@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="text-left">
                <button type="button" class="btn btn-sm mb-1 btn-filter bg-default" data-target="all">All</button>
                <button type="button" class="btn btn-sm mb-1 btn-filter bg-green" data-target="in">IN</button>
                <button type="button" class="btn btn-sm mb-1 btn-filter bg-orange" data-target="out">out</button>
            </div>
            <table class="table table-hover table-custom spacing8 mb-0 dataTable js-exportable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Payment Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report )
                <tr data-status="{{$report->type=='sales_order'?'in':'out'}}">
                        <td class="w60">
                          {{$report->id}}
                        </td>
                        <td>
                          {{$report->type}}
                        </td>
                        <td>
                            {{$report->amount}}
                        </td>
                    <td>{{$report->status}}</td>
                    <td>{{$report->payment_type}}</td>
                      
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row justify-content-lg-center mt-5">
            <h5 class="text-primary">Total Profits: <span>{{$total}}</span></h5>

            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
    <style>
        .buttons-print{
        margin-left: 60%;
        margin-top: -11%;
        }
        .buttons-csv{
            margin-left:50%;
        margin-top: -7%;

        }
        .pagination{
          margin-right: 40% !important;
          margin-top: 1%;
        }
        .dataTables_info{
            margin-left: 40%;
            margin-top: 5%;


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
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/tables/table-filter.js') }}"></script>
@stop