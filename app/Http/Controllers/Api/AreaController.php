<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Http\Requests\Api\Area\CreateAreaRequest;
use App\Http\Requests\Api\Area\UpdateAreaRequest;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $areas
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
    public function store(CreateAreaRequest $request)
    {
        $area = Area::create($request->all());

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $area
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
        $area = Area::findOrFail($id);

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $area
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
    public function update(UpdateAreaRequest $request, $id)
    {

        $area = Area::findOrFail($id);
        $area->update($request->all());

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $area
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
        $area = Area::findOrFail($id);
        $area->delete();

        return response()->json([
            'status' => 1,
            'msg' => 'success'
        ]);
    }
}
