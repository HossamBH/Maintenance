@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Purchase Orders')


@section('content')
<div class="row justify-content-end">
    <div class="col-3">
        <a class="btn btn-round btn-primary buttons-html5"href="{{url('purchaseOrders/create')}}">
            <span>Add Purchase Order</span>
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
                                <th>#</th>
                                <th>Supplier Name</th>
                                <th>Inventory Name</th>
                                <th>Total Amount</th>
                                <th>Expected Arrival Date</th>
                                <th>Date/Time</th>
                                {{-- <th>Options</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($purchaseOrders as $purchaseOrder)
                            <tr>
                                <td>{{$purchaseOrder->id}}</td>
                                <td>{{$purchaseOrder->supplier->company_name}}</td>
                                <td>{{$purchaseOrder->inventory->name}}</td>
                                <td>{{$purchaseOrder->total_amount}}</td>
                                <td>{{$purchaseOrder->expected_on}}</td>
                                <td>{{$purchaseOrder->created_at}}</td>
                                {{-- <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-toggle="dropdown">
                                            Options
                                        </button>
                                        <div class="dropdown-menu row">
                                            <div class="col-12 ml-2">
                                                <a href="{{url("/offers/{$offer->id}/edit")}}"><i
                                    class="fa fa-edit"></i>Edit</a>
                </div>
                <div class="col-12">
                    <form action="{{url("/offers/{$offer->id}")}}" method="post">
                        <button style="background-color: white;border:thick;" class="text-danger">
                            <i class="fa fa-trash-o"></i>Delete
                        </button>

                        @method('DELETE')
                        @csrf
                    </form>
                </div>


            </div>
        </div>
        </td> --}}

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
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop
