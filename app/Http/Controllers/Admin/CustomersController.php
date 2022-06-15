<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::select('*')->orderBy('id', 'desc')->get();
        return view('manager.customers.index', [
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.customers.create');
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
            'name' => 'unique:customers,name|required',
            'zrb' => 'sometimes',
            'phone' => 'required',
            'address' => 'sometimes',
            'email' => 'sometimes|email|unique:customers,email',
            'company' => 'sometimes',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'zrb' => $request->zrb ? $request->zrb : null,
            'phone' => $request->phone ? $request->phone : null,
            'address' => $request->address ? $request->address : null,
            'email' => $request->email ? $request->email : null,
            'company' => $request->company ? $request->company : null,
        ]);

        if( !$customer ){
            return redirect()->back()->withErrors(['model' => 'fail to register  customer'])->withInput();
        }


        return redirect('/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('manager.customers.show')->with('customer', $customer);
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
        $customer = Customer::find($id);
        if( !$customer ){
            return redirect()->back()->withErrors(['model' => 'customer wasn\'t found']);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'exclude_if:name,'.$customer->name.'|unique:customers,name|required',
            'zrb' => 'sometimes',
            'phone' => 'required',
            'address' => 'sometimes',
            'email' => 'exclude_if:email,'.$customer->email.'|sometimes|email|unique:customers,email',
            'company' => 'sometimes',
        ]);
    
        if( $validator->fails() ){
            return redirect()->back()->withErrors($validator->errors());
        }

        $customer->update( $request->all() );

        session()->flash('success', 'customer updated successfully');
        return redirect('/customers/'.$customer->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if( !$customer ){
            return redirect()->back()->withErrors(['model' => 'customer not found']);
        }
        $customer->delete();
        return redirect()->route('customers.index');
    }

    function search($text){
        $customers = Customer::where('name', 'like', '%'.$text.'%')->get();
         return response()->json($customers);
    }
}
