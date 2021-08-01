<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tax;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Payment\CreatePaymentRequest;
use App\Http\Requests\Admin\Payment\UpdatePaymentRequest;
use App\Models\PurchaseOrder;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        //dd($payments);
        //dd($payments->purchaseOrder);
        return view('Admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchaseOrders = PurchaseOrder::all();
        return view('Admin.payments.create', compact('purchaseOrders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePaymentRequest $request)
    {
        $total = PurchaseOrder::where('id', $request->input('po_id'))->first();
        $payment = new Payment;
        $payment->po_id = $request->input('po_id');
        $payment->payment_type = $request->input('payment_type');
        $payment->user_id = auth()->user()->id;
        $payment->paid = $request->input('paid');
        $remaining = $total->remaining - $payment->paid;
        if ($remaining < 0) {
            return redirect(route('admin.payments.create'))->withErrors('You have Paid More Than The Needed');
        }
        //dd($request->hasFile('file_attachment'));
        if ($request->file_attachment) {
            $image = $request->file_attachment;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('attachment'), $image_new_name);
            $payment->file_attachment = '/attachment/' . $image_new_name;
        }
        $payment->remaining = $remaining;
        $payment->comments = $request->input('comments');
        $payment->save();
        return redirect(route('admin.payments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return view(('Admin.payments.show'), compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return view(('Admin.payments.edit'), compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request, $id)
    {
        $total = PurchaseOrder::where('id', $request->input('po_id'))->first();
        $payment = Payment::findOrFail($id);
        $payment->po_id = $request->input('po_id');
        $payment->payment_type = $request->input('payment_type');
        $payment->user_id = auth()->user()->id;
        $payment->paid = $request->input('paid');
        $remaining = $total->remaining - $payment->paid;
        if ($remaining < 0) {
            return redirect(route('admin.payments.edit'))->withErrors('You have Paid More Than The Needed');
        }
        //dd($request->hasFile('file_attachment'));
        if ($request->file_attachment) {
            $image = $request->file_attachment;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('attachment'), $image_new_name);
            $payment->file_attachment = '/attachment/' . $image_new_name;
        }
        $payment->remaining = $remaining;
        $payment->comments = $request->input('comments');
        $payment->save();
        return redirect(route('admin.payments.index'));
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
