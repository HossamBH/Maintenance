<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\TaxType\CreateTaxTypeRequest;
use App\Http\Requests\Api\TaxType\UpdateTaxTypeRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\TaxType;

class TaxTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tax_types = TaxType::all();

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $tax_types
        ]);
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
    public function store(CreateTaxTypeRequest $request)
    {
        $tax_type = TaxType::create($request->all());

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $tax_type
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tax_type = TaxType::findOrFail($id);

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $tax_type
        ]);
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
    public function update(UpdateTaxTypeRequest $request, $id)
    {
        $tax_type = TaxType::findOrFail($id);
        $tax_type->update($request->all());

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $tax_type
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax_type = TaxType::findOrFail($id);
        $tax_type->delete();

        return response()->json([
            'status' => 1,
            'msg' => 'success'
        ]);
    }
}
