<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Item;

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
        $items = Item::orderBy('id', 'desc')->paginate(100);
        // return $items; 

        $stock = Stock::find($id);
        
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

}
