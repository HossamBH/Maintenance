<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Category\CreateCategoryRequest;
use App\Http\Requests\Api\Category\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catigories = Category::all();

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $catigories
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
    public function store(CreateCategoryRequest $request)
    {
        $user = Auth::user();

        $category = new Category;
        $category->name = $request->name;
        $category->tax_id = $request->tax_id;
        $category->user_id = $user->id;
        $category->save();

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $category
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
        $category = Category::findOrFail($id);

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $category
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
    public function update(UpdateCategoryRequest $request, $id)
    {
        $user = Auth::user();

        $category = Category::findOrFail($id);
        $category->update($request->all());
        $category->user_id = $user->id;
        $category->save();

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $category
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
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'status' => 1,
            'msg' => 'success'
        ]);
    }
}
