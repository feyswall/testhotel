<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

use App\Imports\ItemsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('id', 'desc')->paginate(100);
        return view('manager.items.index')
        ->with('items', $items );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect('/items');
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
        $item = Item::where('id', $id)->first();
        if( !$item ){
            return redirect()->back()->withErrors('error' , 'item not found...');
        }
        if( $item->sales()->exists() ){
            $item->sales()->detach();
        }else{}
        $item->delete();
        return redirect()->back()->with('success', 'Item deleted successfully...');
    }


   public function search($text)
   {
        $items = Item::where('code', 'like', '%'.$text.'%' )->get();

        return response()->json($items);

    }



    public function importItems(Request $request)
    {

        $rules = [
            'excel' => 'mimes:ods,xlsx|required|max:500',
        ];

        $validate = Validator::make( $request->all(), $rules, $messages = [
            'excel.required' => 'Select Excel sheet First....',
            'excel.max' => 'ExcelSheet must not be greater than 500kb',
        ] )->validate();

        $path = $request->file('excel')->store('public/itemExcel');

        $path = str_replace('public/itemExcel/', '', $path );

        $excel_path = 'storage/itemExcel/'.$path;

        if( !(Storage::disk('local')->exists($path)) ){
            return redirect()->back()->with('error', 'file upload fails');
        }

        Excel::import(new ItemsImport, $excel_path );

        Storage::disk('local')->delete($path);

        return redirect()->back()->with('excelSuccess', 'DATA SAVED SUCCESSFULLY');

    }



}
