<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Offer;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Offer\CreateOfferRequest;
use App\Http\Requests\Admin\Offer\UpdateOfferRequest;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::all();
        return view('Admin.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Admin.offers.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOfferRequest $request)
    {

        foreach ($request->input('item_id') as $key => $value) {
            $item = Item::find($value);
            $offer = new Offer;
            $offer->category_id = $request->input('category_id');
            $offer->item_id = $value;
            $offer->discount_type = $request->input('discount_type');
            $offer->discount_value = $request->input('discount_value');
            if ($request->input('discount_type') == 'precentage') {
                $offer->price_after_discount = $item->price - (($item->price / 100.00) * $request->input('discount_value'));
            }
            if ($request->input('discount_type') == 'amount') {
                $offer->price_after_discount = $item->price - $request->input('discount_value');
            }
            $offer->category_id = $request->input('category_id');
            $offer->save();
        }



        return redirect(route('admin.offers.index'));
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

        $categories = Category::all();
        $items = Item::all();
        $offer = Offer::findOrFail($id);
        return view('Admin.offers.edit', compact('categories', 'items', 'offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferRequest $request, $id)
    {
        $offer = Offer::findOrFail($id);
        foreach ($request->input('item_id') as $key => $value) {
            $item = Item::find($value);
            $offer->category_id = $request->input('category_id');
            $offer->item_id = $value;
            $offer->discount_type = $request->input('discount_type');
            $offer->discount_value = $request->input('discount_value');
            if ($request->input('discount_type') == 'precentage') {
                $offer->price_after_discount = $item->price - (($item->price / 100.00) * $request->input('discount_value'));
            }
            if ($request->input('discount_type') == 'amount') {
                $offer->price_after_discount = $item->price - $request->input('discount_value');
            }
            $offer->category_id = $request->input('category_id');
            $offer->save();
        }
        return redirect(route('admin.offers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();
        return back();
    }
}
