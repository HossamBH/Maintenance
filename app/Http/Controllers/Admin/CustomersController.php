<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\City;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\CreateCustomerRequest;
use App\Http\Requests\Admin\Customer\UpdateCustomerRequest;



class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('Admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('Admin.customers.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request)
    {
        try {

            $customer = new Customer;
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->mobile = $request->input('mobile');
            $customer->city_id = $request->input('city_id');
            $customer->area_id = $request->input('area_id');
            $customer->address = $request->input('address');
            $customer->save();
        } catch (\Exception $ex) {
            dd($ex);
        }

        return redirect(route('admin.customers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cities = City::all();
        $areas = Area::all();
        $customer = Customer::findOrFail($id);
        $brands = CarBrand::all();
        $models = CarModel::all();
        $cars = Car::where('customer_id', $customer->id)->get();
        return view('Admin.customers.show', compact('customer', 'cities', 'areas', 'cars', 'brands', 'models'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::all();
        $areas = Area::all();
        $customer = Customer::findOrFail($id);
        return view('Admin.customers.edit', compact('customer', 'cities', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return redirect(route('admin.customers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return back();
    }
    //get areas
    public function getAreas($city_id)
    {
        $areas = Area::where('city_id', '=', $city_id)->select('*')->get()->toArray();
        return response()->json($areas);
    }
}
