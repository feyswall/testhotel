<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Sale;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Items;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mode)
    {
        $sales = Sale::where('cash_mode', $mode)->get();
        return view('manager.sales.index')
        ->with('sales', $sales)
        ->with('mode', $mode);
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
        // save customer id in sales table
        $items = $request->items;

        // making sure that the selected customer is plesent
        $customer = Customer::find($customer_id);
        if( !$customer ){
            return response()->json(['error' => 'customer not found... ']);
        }

        // create sale object for current  session
        $sale = Sale::create([
            'customer_id' => $customer_id,
            'cash_mode' => 2
        ]);

        // checking if the sale object is created and return error if not
        if( !$sale ){
            return response()->json(['error' => 'sale not found...']);
        }

        // finally loop throgh every item and attach to the current sale
        foreach( $items as $item ){

                $sale->items()->attach($item['item_id'], [
                    'quantity' => $item['item_quantity'],
                    'due_price' => $item['due_price'],
                    'due_tax' => $item['due_tax'],
                ]);

        }

        return $sale->id;
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

    function proforma($id){
        $sale = Sale::where('cash_mode', 2)->where('id', $id)->first();
        if(!$sale){
            return redirect('/sales/2');
        }
        $items = $sale->items;
        $customer = $sale->customer;
        return view('manager.sales.proforma')->with([
            'items' => $items,
            'sale' => $sale,
            'customer' => $customer
        ]);
    }

    public function make_invoice(Request $request, $id){

        $sale = Sale::find($id);

        $checked = $request->item_id;

        if($checked){
            foreach($checked as $item){
                $item = $sale->items()->where('item_id', $item)->first();
                if( $item ){
                    $item->pivot->invoice_mode = 1;
                    $item->pivot->save();
                }
            }
        }
        return redirect()->back();
    }
}
