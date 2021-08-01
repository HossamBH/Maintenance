@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Maintenance')
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
            <h6>Customer Name:</h6>
            <p>{{$maintenance->car->customer->name}}</p>
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-6">
                    <p class="m-b-2"><strong>Order Date: </strong>{{ Carbon\Carbon::parse($maintenance->created_at)->format('Y-m-d') }}</p>
                    <p><strong>Order ID: </strong> {{$maintenance->id}}</p>                                    
                    </div>
                    <div class="col-md-6 col-sm-6 text-right">
                        
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom spacing5 mb-5">
                                <thead>
                                    <tr>
                                        <th>#</th>                                                        
                                        <th>Item/Service</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th class="hidden-sm-down">Price</th>
                                        <th class="hidden-sm-down">Tax</th>
                                        <th style="text-align: right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                       
                                    @foreach ($servicesMaintenaces as $item_salesorder)
                                    <tr>
                                        @if($item_salesorder->entity=='item')
                                        @php
                                            $item=\App\Models\Item::find($item_salesorder->entity_id);
                                        @endphp
                                     
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>

                                        <td>
                                        <span></span>
                                        <p class="hidden-sm-down mb-0 text-muted">{{$item->description}}</p>
                                        </td>                                                    
                                    <td>{{$item_salesorder->quantity}}</td>
                                    <td>{{$item->taxed_price}}</td>
                                    <td>{{$item->category->tax->percentage*$item->price/100}}</td>

                                    <td class="text-right">{{$item->taxed_price*$item_salesorder->quantity}}</td>
                                    </tr>
                                    @endif
                                    @if($item_salesorder->entity=='service')
                                    @php
                                        $service=\App\Models\Service::find($item_salesorder->entity_id);
                                    @endphp
                                 
                                <td>{{$service->id}}</td>
                                <td>{{$service->name}}</td>
                                       <td></td>
                                       <td></td>                                                   
                            
                                <td>{{$service->cost}}</td>
                                <td>{{$service->tax*$service->cost/100}}</td>
                                <td class="text-right">{{$service->cost+$service->tax*$service->cost/100}}</td>

                           
                                </tr>
                                @endif
                                    @endforeach   
                                               
                                                                          
                                </tbody>
                                <tfoot>
                                 
                                    
                                </tfoot>
                                 <tr class="text-center">
                                    <td colspan="3"></td>
                                    <td class="">
                                    <span>Total Taxes: <strong class="text-success">{{$maintenance->taxes}}  LE</strong></span>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="3"></td>
                                    <td class="">
                                    <span>Total: <strong class="text-success">{{$maintenance->total}}  LE</strong></span>
                                    </td>
                                </tr>
                               
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                   
                    <div class="col-md-6 text-right">
                        <button class="btn btn-info"><i class="icon-printer"></i> Print</button>
                    </div>
                </div> 
            </div>
        </div>                                       
    </div>
</div>
@stop

@section('page-styles')
@stop

@section('page-script')
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
@stop