<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\Item;
use App\Models\Report;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ServiceMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenances=Maintenance::all();
        return view('Admin.serviceMaintenance.index',compact('maintenances'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $items = Item::all();
        $cars=Car::all();
        $services=Service::all();
        return view('Admin.serviceMaintenance.create', compact('customers', 'items','cars','services'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $subTotal=0;
        $tax=0;
        $total=0;
        $SRsubTotal=0;
        $SRtax=0;
        $SRtotal=0;
        $IsubTotal=0;
        $Itax=0;
        $Itotal=0;
        //dd($request->input('item_id'));
        $maintenance =new Maintenance;
        $maintenance->car_id=$request->input('car_id');
        $maintenance->entrance_date=$request->input('entrance_date');
        $maintenance->duration=$request->input('duration');
        $maintenance->delivery_date=$request->input('delivery_date');
        $maintenance->comments=$request->input('comments');
        $maintenance->kms=$request->input('kms');

        $maintenance->user_id=auth()->user()->id;
        foreach ($request->input('service_id') as $key => $value){
            $service=Service::Find($value);
    
                    $SRsubTotal+= $service->cost;
                    $SRtax+= $service->cost*$service->tax/100;
                    $SRtotal = $SRsubTotal + $SRtax;
                    $maintenance->subtotal=$SRsubTotal;
                    $maintenance->total=$SRtotal;
                    $maintenance->taxes=$SRtax;
                    $maintenance->save();
                    DB::table('maintenance_services')->insert(
                        array(
                            'entity_id'=>$service->id,
                            'maintenance_id'=>$maintenance->id,
                            'entity'=>'service',
                            'subtotal'=>$SRsubTotal,
                            'total'=>$SRtotal,
                            'taxes'=>$SRtax
                        )
                    );
            
                    
            }
        
        foreach ($request->input('item_id') as $key => $value){
            $item=Item::Find($value);
            foreach ($request->input('quantity') as $index => $row) {
                if($key == $index){
                    $IsubTotal+= $row*$item->price;
                    $Itax+= $item->price*$row*$item->category->tax->percentage/100;
                    $Itotal = $IsubTotal + $Itax;
                    $maintenance->subtotal=$IsubTotal;
                    $maintenance->total=$Itotal;
                    $maintenance->taxes=$Itax;
                    $maintenance->save();
                    DB::table('maintenance_services')->insert(
                        array(
                            'entity_id'=>$item->id,
                            'maintenance_id'=>$maintenance->id,
                            'quantity'=>$row,
                            'entity'=>'item',
                            'subtotal'=>$IsubTotal,
                            'total'=>$Itotal,
                            'taxes'=>$Itax
                        )
                    );
                   /* 
                    $stock = DB::table('inventory_item')->where('item_id', $item->id)->first();
                    if($row>$stock->quantity)
                    {
                        $maintenance->delete();
                        return redirect(route('admin.maintenances.create'))->withError('No enough data');

                    }
                    else{
                        $stock->quantity -= $row;
                        $stock = DB::table('inventory_item')->where('item_id', $item->id)->update(['quantity'=> $stock->quantity]); 
                    }
                }*/
            } 
        }
        /*
        $report=new Report;
        $report->entity_id=$maintenance->id;
        $report->type='sales_order';
        $report->status='in';
        $report->payment_type=$maintenance->payment_type;
        $report->amount=$maintenance->total_amount;
        $report->save();  */
    }
    $subTotal=$SRsubTotal+$IsubTotal;
    $tax=$SRtax+$Itax;
    $maintenance->subtotal=$subTotal;
    $maintenance->taxes=$tax;
    $maintenance->total=$subTotal+$tax;
    $maintenance->save();
    return redirect(route('admin.serviceMaintenance.index'));


}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maintenance=Maintenance::find($id);
       // dd($id);
        $servicesMaintenaces=Maintenance::join('maintenance_services','maintenance_services.maintenance_id','=','maintenances.id')
     ->select('maintenance_services.*','maintenances.*')
     ->where('maintenance_services.maintenance_id',9)->get();
    // dd($servicesMaintenaces);
        return view('Admin.serviceMaintenance.show',compact('maintenance','servicesMaintenaces'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
