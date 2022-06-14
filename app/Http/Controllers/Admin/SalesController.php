<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mode)
    {
        return view('manager.sales.index')->with('mode', $mode);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer_id = $request->customer_id;

        $sale = new Sale();
        $sale->customer_id = $customer_id;
        $sale->invoice_number = '';
        $sale->save();

        $sales_id = $sale->id;
        // save customer id in sales table
        $items = $request->items;

        for($i = 0; $i < sizeof($items); $i++){
            //loop and save items in sales_items table
            $item_id = $items[$i]['item_id'];
            $item_quantity = $items[$i]['item_quantity'];
            $due_price = $items[$i]['due_price'];
            $due_tax = $items[$i]['due_tax'];

            $sale_item = new SaleItem();
            $sale_item->sales_id = $sales_id;
            $sale_item->item_id = $item_id; 
            ////all
            $sale_item->save();
        }
        return 1;
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
}
