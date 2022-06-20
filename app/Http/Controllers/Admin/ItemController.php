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
       $rules = [
            'code' => 'required|unique:items,code',
            'selling_price' => 'required|numeric',
            'gross_price' => 'required|numeric',
       ];

       $validate = Validator::make( $request->all(), $rules )->validate();

       $item = Item::create([
           'name' => $request->code,
           'code' => $request->code,
           'selling_price' => $request->selling_price,
           'desc' => $request->desc,
           'pref_supplier' => $request->pref_supplier,
           'gross_price' => $request->gross_price,
       ]);

       if( !$item ){
           return redirect()->back()->with('erro', 'fail to create item..');
       }
       return redirect()->route('admin.items.index')->with('success', 'item created successfully...');
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
        $item = Item::find($id);
        if( !$item ){
            return redirect()->back()->with('error', 'item wasn\'t found');
        }

        return view('manager.items.edit', ['item' => $item ]);
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
        $item = Item::find($id);
        if( !$item ){
            return redirect()->back()->with('error', 'Item wasn\'t found');
        }

        $rules = [
            'selling_price' => 'required|numeric',
            'gross_price' => 'required|numeric',
       ];

       if( $request->code != $item->code ){
           $rules['code'] = 'required|unique:items,code';
       }else{
           $rules['code'] = 'required|code';
       }

       $validate = Validator::make( $request->all(), $rules )->validate();
    
    
    
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

        // dd( request()->getHost() );
        // dd( request()->getHost().'/itemExcel' );
        $rules = [
            'excel' => 'mimes:ods,xlsx|required|max:500',
        ];

        $validate = Validator::make( $request->all(), $rules, $messages = [
            'excel.required' => 'Select Excel sheet First....',
            'excel.max' => 'ExcelSheet must not be greater than 500kb',
        ] )->validate();



        $path = $request->file('excel')->storePublicly('public/itemExcel');

        // $path = str_replace('public/itemExcel/', '', $path );


        if( !(Storage::disk('local')->exists($path)) ){
            return redirect()->back()->with('error', 'file upload fails');
        }

        Excel::import(new ItemsImport, Storage::disk('local')->path($path) );

        Storage::disk('local')->delete($path);



        // $img = $request->file('excel');

        // $ext = $img->getClientOriginalExtension();

        // $name = time().'.'.$ext;

        // $path = request()->getHost().'/itemExcel';

        // $img->move($path, $name);


        return redirect()->back()->with('excelSuccess', 'DATA SAVED SUCCESSFULLY');

    }



}
