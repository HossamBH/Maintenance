<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Item\CreateItemRequest;
use App\Http\Requests\Api\Item\UpdateItemRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $items
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
    public function store(CreateItemRequest $request)
    {
        $user = Auth::user();

        $item = new Item;
        $item->name = $request->name;
        $item->serial_number = $request->serial_number;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->taxed_price = $request->taxed_price;
        $item->active = $request->active;
        $item->unit = $request->unit;
        $item->category_id = $request->category_id;
        $item->user_id = $user->id;
        $item->save();

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $item
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
        $item = Item::findOrFail($id);

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $item
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
    public function update(UpdateItemRequest $request, $id)
    {
        $user = Auth::user();

        $item = Item::findOrFail($id);
        $item->update($request->all());
        $item->user_id = $user->id;
        $item->save();

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $item
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
        $item = Item::findOrFail($id);
        $item->delete();

        return response()->json([
            'status' => 1,
            'msg' => 'success'
        ]);
    }
}
