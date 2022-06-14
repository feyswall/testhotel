<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Sale;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Items;

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
        // $rules = [
        //     'item_id' => 'required',
        //     'item_quantity' => 'required',
        //     'due_price' => 'required',
        //     'due_tax' => 'required',
        //     'customer_id' => 'required',
        // ];
        
        // $validate = Validator::make( $request->all(), $rules );
        
        // if( $validate->fails() ){
        //     return redirect()->back()
        //     ->withErrors(
        //         ['error' => 'validation', 'data' => $validate->errors()->all()]);
        // }


        $customer_id = 1;
        // save customer id in sales table
        $items = $request->items;

        //loop and save items in sales_items table
        $item_id = $items[0]['item_id'];
        $item_quantity = $items[0]['item_quantity'];
        $due_price = $items[0]['due_price'];
        $due_tax = $items[0]['due_tax'];
        

        $customer = Customer::find($customer_id);
        if( !$customer ){
            return response()->json(['error' => 'customer not found... ']);
        }
        

        $sale = Sale::create([
            'customer_id' => $customer_id,
        ]);
        

        if( !$sale ){
            return response()->json(['error' => 'sale not found...']);
        }

        foreach( $items as $item ){

            $item = Item::find( $item['item_id']);

            if( $item ){
                $sale->items()->attach(1, [
                    'quantity' => $item['item_quantity'], 
                    'due_price' => $item['due_price'],
                    'due_tax' => $item['due_tax'], 
                ]);
            }

        }
        

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