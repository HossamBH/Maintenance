<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Tax\CreateTaxRequest;
use App\Http\Requests\Api\Tax\UpdateTaxRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Tax;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = Tax::all();

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $taxes
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
    public function store(CreateTaxRequest $request)
    {
        $tax = Tax::create($request->all());

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $tax
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
        $tax = Tax::findOrFail($id);

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $tax
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
    public function update(UpdateTaxRequest $request, $id)
    {
        $tax = Tax::findOrFail($id);
        $tax->update($request->all());

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $tax
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
        $tax = Tax::findOrFail($id);
        $tax->delete();

        return response()->json([
            'status' => 1,
            'msg' => 'success'
        ]);
    }
}
