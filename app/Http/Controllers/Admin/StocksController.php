<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\InStock;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class StocksController extends Controller
{
    public function __contruct(){
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function index(){
        $stocks = Stock::all();
        return view('admin.stock.index', [
            'stocks' => $stocks,
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
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:stocks,name',
            'location' => 'required',
            'desc' => 'required|string'
        ];

        $validate = Validator::make( $request->all(), $rules )->validate();

        $stock = Stock::create([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'desc' => $request->input('desc'),
        ]);

        if( !$stock ){
            return redirect()->back()->with('fail', 'fail to create stock');
        }
        return redirect()->back()->with('success', 'Stck created Successfully..');
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
        $stock = Stock::find($id);

        if( !$stock ){
            return redirect()->back()->with('error', 'unable to find stock');
        }
        $stock_items = $stock->items()->select('*')->pluck('item_id');

        $items = Item::whereNotIn('id', $stock_items)->paginate(100);

        return view('admin.stock.edit', [
            'stock' => $stock,
            'items' => $items,
        ]);
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
        $rules = [
            'location' => 'required',
            'desc' => 'required',
        ];
        $stock = Stock::find($id);
        if( !$stock ){
            return redirect()->back()->with('error', 'unable to find stock...');
        }
        if( $stock->name == $request->name ){
            $rules['name'] ='required';
        }else{
            $rules['name'] = 'required|unique:stocks,name';
        }

        Validator::make( $request->all(), $rules )->validate();

        $status = $stock->update([
            'name' => $request->name,
            'location' => $request->location,
            'desc' => $request->desc,
        ]);

        if( !$status ){
            return redirect()->back()->with('error', 'fail to update stock.');
        }
        return redirect()->back()->with('success', 'Stock updated Successfully...');
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



    public function addItem(Request $request, $id){
        $rules = [
            'item_id' => 'required|unique:item_stock,item_id',
            'quantity' => 'required',
        ];
        Validator::make($request->all(), $rules)->validate();

        $item = Item::find($request->item_id);

        $stock = Stock::find($id);
        if( !$stock ){
            return redirect()->back()->with('error', 'stock was\'t found');
        }

        if( !$item ){
            return redirect()->back()->with('error', 'item wasn\'t found');
        }
        $attachment = $stock->items()->attach($item->id, ['quantity' => $request->quantity]);

        return redirect()->route('admin.stock.edit', $stock->id)->with('success', 'product added in stock');
    }


    public function updateItemNumber(){

    }



    /**
     * for  attaching many items in the database with initial
     * quantity of zero
     */
    public function addItems(Request $request, $id){

        $rules = [
            'list' => 'required|array',
            'list.*.item_id' => 'required|unique:item_stock,item_id',
            'list.*.item_quantity' => 'required|numeric',
            'list.*.due_price' => 'required|numeric',
        ];
        $validate = Validator::make($request->all(), $rules, $messages = [
            'list.*.item_id.required' => 'The product name aready taken', 
            'list.*.item_quantity.numeric' => 'only numbers allowed in quantities',
            'list.*.due_price' => 'Only numbers allowed in price',
        ]);

        if( $validate->fails() ){
            return response()->json(['error' => 'validation error', 'data' => $validate->errors()->all()]);
        }

        $stock = Stock::find($id);

        if( !$stock ){
            return response()->json(['error', 'unable to locate stock.. maybe deleted!']);
        }

        foreach( $request->list as $item ){

            $stock->items()->attach($item['item_id']);
        
             $item_stock_id = DB::table('item_stock')->select('id')->
             orderByDesc('id')->first();

            // adding the upcoming item in stock "inStock"
            InStock::create([
                'quantity' => $item['item_quantity'],
                'date_in' => \Carbon\Carbon::now(),
                'old_item_price' => $item['due_price'],
                'stock_id' => $stock->id,
                'item_id' => $item['item_id'],
                'item_stock_id' => $item_stock_id->id,
                'stock_mode_id' => 1,
            ]);

        }
        // if( !$stock ){
        //     return redirect()->back()->with('error', 'stock was\'t found');
        // }
        return response()->json(['success', 'data saved Successfullty...']);
    }

}
