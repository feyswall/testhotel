<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.home', [
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'sometimes',
            'phone' => 'required',
            'tin' => 'sometimes',
            'vrn' => 'sometimes',
            'address' => 'sometimes',
            'details' => 'sometimes',
        ]);

        $supplier = Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email ? $request->email : null,
            'tin' => $request->tin ? $request->tin : null,
            'vrn' => $request->vrn ? $request->vrn : null,
            'address' => $request->address ? $request->address : null,
            'details' => $request->details ? $request->details : null,
        ]);

        if( !$supplier ){
            return redirect()->back()->with('error', 'fail to add a supplier');
        }

        session()->flash('success', 'supplier updated successfully..');
        return redirect()->route('admin.supplier.edit', $supplier->id);
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
        $supplier = Supplier::where('id', $id)->first();
        return view('admin.supplier.edit', ['supplier' => $supplier]);
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
        dd( 'start update' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        if( !$supplier ){
            return redirect()->back()->withErrors(['error' => 'supplier wasn\'t found']);
        }
        $name = $supplier->name;
        $supplier->delete();
        return redirect()->route('admin.supplier.index')->with('success', $name.' was deleted  successfully...');
    }
}
