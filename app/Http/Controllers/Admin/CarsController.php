<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Customer;
use App\Models\Year;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Car\CreateRequest;
use App\Http\Requests\Admin\Car\UpdateRequest;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        return view('Admin.Cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $models = CarModel::all();
        $brands = CarBrand::all();
        $customers = Customer::all();
        $years = Year::all();
        return view('Admin.Cars.create', compact('models', 'brands', 'customers', 'years'));
    }

    public function create()
    {
        $models = CarModel::all();
        $brands = CarBrand::all();
        $customers = Customer::all();
        return view('Admin.Cars.create', compact('models', 'brands', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $car = new Car;
        $car->kms = $request->input('kms');
        $car->customer_id = $request->input('customer_id');
        $car->model_id = $request->input('model_id');
        $car->color = $request->input('color');
        $car->license_number = $request->input('license_number');
        $car->motor_no = $request->input('motor_no');
        $car->year = $request->input('year');
        $car->type = $request->input('type');
        if ($request->input('comments')) {
            $car->comments = $request->input('comments');
        }
        $car->user_id = auth()->user()->id;
        $car->save();
        return redirect(route('admin.cars.index'));
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

        $models = CarModel::all();
        $brands = CarBrand::all();
        $car = Car::FindOrFail($id);
        $customers = Customer::all();
        $years = Year::all();
        return view('Admin.Cars.edit', compact('car', 'models', 'brands', 'customers', 'years'));
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
        $car = Car::FindOrFail($id);
        $car->update($request->all());
        return redirect(route('admin.cars.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cars = Car::FindOrFail($id);
        $cars->delete();
        return back();
    }
}
