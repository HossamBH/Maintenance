<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tax;
use App\Models\TaxType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tax\CreateTaxRequest;
use App\Http\Requests\Admin\Tax\UpdateTaxRequest;

class TaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = Tax::all();
        return view('Admin.taxes.index', compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TaxType::all();
        return view('Admin.taxes.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaxRequest $request)
    {
        $tax = Tax::create($request->all());
        return redirect(route('admin.taxes.index'));
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
        $tax = Tax::findOrFail($id);
        $types = TaxType::all();
        return view('Admin.taxes.edit', compact('tax', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxRequest $request, $id)
    {
        $tax = Tax::findOrFail($id);
        $tax->update($request->all());
        return redirect(route('admin.taxes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = Tax::findOrFail($id);
        $tax->delete();
        return back();
    }
}
