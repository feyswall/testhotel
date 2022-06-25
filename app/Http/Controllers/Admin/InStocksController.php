<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\StockProductTrait;
use Illuminate\Support\Facades\Validator;
use App\Models\InStock;
use App\Models\Item;
use App\Models\StockModes;

class InStocksController extends Controller

{
    use StockProductTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function stockItemAddNewInExisting(Request $request){
       
        $rules = [
            'item_id' => 'required',
            'stock_id' => 'required',
            'inDate' => 'required',
        ];

        Validator::make( $request->all(), $rules )->validate();

        $item = Item::find($request->item_id);

        if( !$item ){
            return redirect()->back()->with('error', 'Product not found...');
        }

        $mode = StockModes::where('name', 'receive_purchased')->first();

        $inStock = InStock::create([
            'item_id' => $request->item_id,
            'stock_id' => $request->stock_id,
            'date_in' => $request->inDate,
            'quantity' => $request->quantity,
            'old_item_price' => $item->selling_price,
            'stock_mode_id' => $mode->id,
        ]);

        if( !$inStock ){
            return redirect()->back()->with('error', 'Fail to add Product in stock...');
        }
        return redirect()->back()->with('success', 'Data inserted successfully...');

    }
}
