<?php

namespace App\Http\Controllers\Admin;

use App\Models\TaxType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaxType\CreateTaxTypeRequest;
use App\Http\Requests\Admin\TaxType\UpdateTaxTypeRequest;

class TaxTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = TaxType::all();
        return view('Admin.taxTypes.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.taxTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaxTypeRequest $request)
    {
        $type = TaxType::create($request->all());
        return redirect(route('admin.taxTypes.index'));
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
        $type = TaxType::findOrFail($id);
        return view('Admin.taxTypes.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxTypeRequest $request, $id)
    {
        $type = TaxType::findOrFail($id);
        $type->update($request->all());
        return redirect(route('admin.taxTypes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = TaxType::findOrFail($id);
        $type->delete();
        return back();
    }
}
