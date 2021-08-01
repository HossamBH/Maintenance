<?php

namespace App\Http\Controllers\Admin;

use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CarModel\CreateRequest;
use App\Http\Requests\Admin\CarModel\UpdateRequest;

class CarModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carModels=CarModel::all();
     
        return view('Admin.CarModels.index',compact('carModels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands=CarBrand::all();
        return view('Admin.CarModels.create',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $carModel=CarModel::create($request->all());
        return redirect(route('admin.carModels.index'));
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
        $carModel=CarModel::FindOrFail($id);
        $brands=CarBrand::all();

        return view('Admin.CarModels.edit',compact('carModel','brands'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $carModel=CarModel::FindOrFail($id);
        $carModel->update($request->all());
        return redirect(route('admin.carModels.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carModel=CarModel::FindOrFail($id);
        $carModel->delete();
        return back();
    }
}
