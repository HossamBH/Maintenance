<?php

namespace App\Http\Controllers\Admin;

use App\Models\SalesOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesorders=SalesOrder::all();
       
        return view('Admin.invoices.index',compact('salesorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
   $salesorder=SalesOrder::find($id);
        $item_salesorders=SalesOrder::join('item_sales_order','item_sales_order.so_id','=','sales_orders.id')
                                ->join('customers','sales_orders.customer_id','=','customers.id')
                             ->select('sales_orders.id as sales_id','sales_orders.sub_total_amount','total_taxes','total_amount','sales_orders.user_id','sales_orders.created_at as Date','item_sales_order.item_id as item','item_sales_order.quantity as quantity','customers.name as customer_name')
                             ->where('sales_orders.id',$id)->get();
//dd($salesorder->items());
        return view('Admin.invoices.show',compact('salesorder','item_salesorders'));
    
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
