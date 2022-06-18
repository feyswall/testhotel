<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\PaymentMethod;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        $data = [];
        foreach($settings as $item){
            $data[$item->key] = $item->value;
        }
        return view('admin.setting.index', compact('data'));
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
    public function update(Request $request)
    {
        dd( $request->all() );
        $data = $request->except(['_token','_method']);
        foreach($data as $key => $value){
            $entry = Setting::where('key', $key)->first();
            if(!$entry){
                Setting::create([
                    'key' => $key, 
                    'value' => $value
                ]);
            }else{
                Setting::where('key', $key)->update(['value' => $value]);
            }
        }
        return redirect()->back()->with('success', 'Company details updated!');
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

    function payment_methods(){
        $methods = PaymentMethod::all();
        return view('admin.setting.methods', compact('methods'));
    }

    function save_method(Request $request){
        PaymentMethod::create([
            'name' => $request->name
        ]);
        return redirect()->back();
    }

    function update_method(Request $request, $id){
        $method = PaymentMethod::find($id);
        if(!$method){
            return redirect()->back();
        } 
        $method->name = $request->name;
        $method->save();
        return redirect()->back();
    }
}
