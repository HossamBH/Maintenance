<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PurchaseOrder\CreateRequest;


class PurchaseOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $purchaseOrders = PurchaseOrder::all();
        return view('Admin.purchaseOrders.index', compact('purchaseOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $inventories = Inventory::all();
        $items = Item::all();
        return view('Admin.purchaseOrders.create', compact('suppliers', 'inventories', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $total = 0;
    
        //dd($request->input('item_id'));
        $purchaseorder = new PurchaseOrder;
        $purchaseorder->supplier_id = $request->input('supplier_id');
        $purchaseorder->inventory_id = $request->input('inventory_id');
        $purchaseorder->expected_on = $request->input('expected_on');
        $purchaseorder->paid = $request->input('paid');
        $purchaseorder->comments = $request->input('comments');
        $purchaseorder->payment_type = $request->input('payment_type');

        $purchaseorder->user_id = auth()->user()->id;
        foreach ($request->input('item_id') as $key => $value) {
            $item = Item::Find($value);
            foreach ($request->input('quantity') as $index => $row) {
                foreach ($request->input('cost') as $costIndex => $cost) {

                    if ($key == $index && $index == $costIndex) {
                        if ($key != 0) {
                            dd($key);
                        }
                        $total += $row * $cost;
                        $purchaseorder->total_amount = $total;
                        $purchaseorder->remaining = $total - $request->input('paid');
                        $purchaseorder->save();
                        $purchaseorder->items()->attach($item->id, ['quantity' => $row, 'cost' => $cost]);

                        $stock = DB::table('inventory_item')->where('inventory_id', $purchaseorder->inventory_id)->where('item_id', $item->id)->first();
                        //dd($stock);
                        if ($stock) {
                            $oldcost = $stock->quantity * $stock->av_cost;
                            $comingcost = $row * $cost;
                            $av_total = $oldcost + $comingcost;
                            $stock->quantity += $row;
                            $av_cost = $av_total / $stock->quantity;
                            $stock = DB::table('inventory_item')->where('inventory_id', $purchaseorder->inventory_id)->where('item_id', $item->id)->update(['quantity' => $stock->quantity, 'av_cost' => $av_cost]);
                        } else {
                            $stockQtn = $row;
                            $stockAvCost = $cost;
                            $stockInventory = $purchaseorder->inventory_id;
                            $stockItem = $item->id;
                            $stockItemUnit = $item->unit;

                            DB::table('inventory_item')->insert(
                                array(
                                    'inventory_id' => $stockInventory,
                                    'item_id' => $stockItem,
                                    'unit' => $stockItemUnit,
                                    'quantity' => $stockQtn,
                                    'av_cost' => $stockAvCost
                                )
                            );
                        }
                    } else {
                        dd($key, $index, $costIndex);
                    }
                }
            }
        }
        $payment = new Payment;
        $payment->po_id = $purchaseorder->id;
        $payment->paid = $purchaseorder->paid;
        $payment->remaining = $purchaseorder->remaining;
        $payment->comments = $purchaseorder->comments;
        $payment->user_id = $purchaseorder->user_id;
        $payment->payment_type = $request->input('payment_type');
        $payment->file_attachment = $request->input('file_attachment');
        $payment->save();

        $paymentReport = new Report;
        $paymentReport->amount = $payment->paid;
        $paymentReport->payment_type = $payment->payment_type;
        $paymentReport->status = 'out';
        $paymentReport->type = 'payment';
        $paymentReport->entity_id = $payment->id;
        $paymentReport->save();

        $PoReport = new Report;
        $PoReport->amount = $purchaseorder->total_amount;
        $PoReport->payment_type = $purchaseorder->payment_type;
        $PoReport->status = 'out';
        $PoReport->type = 'purchase_order';
        $PoReport->entity_id = $purchaseorder->id;
        $PoReport->save();

        return redirect(route('admin.purchaseOrders.index'));
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
