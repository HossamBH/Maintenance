<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Item\CreateItemRequest;
use App\Http\Requests\Admin\Item\UpdateItemRequest;



class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('Admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Admin.items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateItemRequest $request)
    {
        $category = Category::findOrFail($request->input('category_id'));
        $price = $request->input('price');
        if ($category) {
            $tax = $category->tax->percentage;
        }
        $item = new Item;
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->serial_number = $request->input('serial_number');
        $item->price = $price;
        $item->category_id = $request->input('category_id');
        $item->unit = $request->input('unit');
        $item->active = $request->input('active');
        $item->user_id = auth()->user()->id;
        $item->taxed_price = $price + ($tax * $price / 100);
        $item->save();
        return redirect(route('admin.items.index'));
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
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('Admin.items.edit', compact('item', 'categories'));
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
        $item = Item::findOrFail($id);
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->serial_number = $request->input('serial_number');
        $item->price = $request->input('price');
        $item->category_id = $request->input('category_id');
        $item->unit = $request->input('unit');
        $item->active = $request->input('active');
        $item->user_id = auth()->user()->id;
        if ($request->input('price')) {
            $item->taxed_price = $request->input('price') + ($item->category->tax->percentage * $request->input('price') / 100);
        }
        $item->save();
        return redirect(route('admin.items.index'));
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
        return back();
    }
}
