@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Safe')


@section('content')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <div class="text-left">
                        <button type="button" class="btn btn-sm mb-1 btn-filter bg-default"
                            data-target="all">All</button>
                        <button type="button" class="btn btn-sm mb-1 btn-filter bg-green" data-target="in">In</button>
                        <button type="button" class="btn btn-sm mb-1 btn-filter bg-orange"
                            data-target="out">Out</button>
                    </div>
                    <table class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Payment Type</th>
                                <th>Date/Time</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($safes as $safe)
                            <tr data-status="{{$safe->type=='sales_order'?'in':'out'}}">
                                <td>{{$safe->id}}</td>
                                <td>{{$safe->amount}}</td>
                                <td>{{$safe->type}}</td>
                                <td>{{$safe->status}}</td>
                                <td>{{$safe->payment_type}}</td>
                                <td>{{$safe->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class=" text-left">
                        <b class="mr-5">Cash : {{$cashSafe}}</b>
                        <b class="mr-5 ml-5">Visa : {{$visaSafe}}</b>
                        <b class="mr-5 ml-5">Total : {{$currentSafe}}</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<link rel=" stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}" />
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
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}">
</script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}">
</script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}">
</script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}">
</script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}">
</script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/tables/table-filter.js') }}"></script>
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop
