<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Report;
use App\Models\Category;
use App\Models\Customer;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SalesOrder\CreateRequest;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesorders = SalesOrder::all();
        return view('Admin.salesOrders.index', compact('salesorders'));
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
        return view('Admin.salesOrders.create', compact('customers', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $subTotal=0;
        $tax=0;
        $total=0;
        //dd($request->input('item_id'));
        $salesorder =new SalesOrder;
        $salesorder->customer_id=$request->input('customer_id');
        $salesorder->payment_type=$request->input('payment_type');
        $salesorder->user_id=auth()->user()->id;
        foreach ($request->input('item_id') as $key => $value){
            $item=Item::Find($value);
            foreach ($request->input('quantity') as $index => $row) {
                if($key == $index){
                    $subTotal+= $row*$item->price;
                    $tax+= $item->price*$row*$item->category->tax->percentage/100;
                    $total = $subTotal + $tax;
                    $salesorder->sub_total_amount=$subTotal;
                    $salesorder->total_taxes=$tax;
                    $salesorder->total_amount=$total;
                    $salesorder->save();
                    $salesorder->items()->attach($item->id,['quantity'=>$row]);
                    
                    $stock = DB::table('inventory_item')->where('item_id', $item->id)->first();
                    if($row>$stock->quantity)
                    {
                        $salesorder->delete();
                        return redirect(route('admin.salesOrders.create'))->withError('No enough data');

                    }
                    else{
                        $stock->quantity -= $row;
                        $stock = DB::table('inventory_item')->where('item_id', $item->id)->update(['quantity'=> $stock->quantity]); 
                    }
                }
            } 
        }
        $report=new Report;
        $report->entity_id=$salesorder->id;
        $report->type='sales_order';
        $report->status='in';
        $report->payment_type=$salesorder->payment_type;
        $report->amount=$salesorder->total_amount;
        $report->save();      
        
            return redirect(route('admin.salesOrders.index'));
           
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
