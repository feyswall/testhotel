<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category_id = null;
        $categories = Category::where('type', 3)->get();
        if(isset($request->category)){
            $contracts = Contract::where('category_id', $request->category)->get();
            $category_id = $request->category;
        }else{
            $contracts = Contract::all();
        }
        return view('admin.contracts.index', compact('contracts', 'categories', 'category_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('type', 3)->get();
        return view('admin.contracts.create', ['categories' => $categories]);
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
            "name" => 'required|unique:contracts,name',
            "desc" => 'required',
            "party" => 'required',
            "category_id" => 'required',
            "start_date" => "required",
            "end_date" => "required",
            'file' => $request->file ? 'sometimes|nullable|max:204800' : '',
        ];

        Validator::make( $request->all(), $rules, $messages = [
            'start_date.required' => 'Contract Starting  date is required.'
        ] )->validate();

        $img = $request->file('file');

        $ext = $img->getClientOriginalExtension();

        $name = time().'.'.$ext;

        $path = 'contracts-pdf/';

        $img->move($path, $name);

        $contract = Contract::create( [
            "name" => $request->name,
            "desc" => $request->desc,
            "party" => $request->party,
            "category_id" => $request->category_id,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            'contract_pdf' => $name,
        ] );
        if( !$contract ){
            return redirect()->back()->with('error', 'fail to create contract');
        }

        return redirect()->back()
        ->with('success', 'Contract created successfully..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = Contract::find($id);
        $categories = Category::where('type', 3)->get();
        if( !$contract ){
            return redirect()->back()->with('error', 'contract wasn\'t found');
        }
        return view('admin.contracts.show', [
            'contract' => $contract,
             'categories' => $categories
            ]);
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
        $contract = Contract::find($id);
        if( !$contract ){
            return redirect()->back()->with('error', 'Contract does not exist...');
        }

        $rules = [
            "name" => $request->name != $contract->name ? 'required|unique:contracts,name' : 'required',
            "desc" => 'required',
            "party" => 'required',
            "category_id" => 'required',
            "start_date" => "required",
            "end_date" => "required",
            'file' => $request->file ? 'sometimes|nullable|max:204800' : '',
        ];

        Validator::make( $request->all(), $rules, $messages = [
            'start_date.required' => 'Contract Starting  date is required.'
        ] )->validate();

        $saved_file = $contract->contract_pdf;

        if( $request->file ){

            $path_one = 'contracts-pdf/'.$contract->contract_pdf;

            $isExists = file_exists( $path_one );

            if( $isExists ){
                File::delete( $path_one );
            }

            $img = $request->file('file');
    
            $ext = $img->getClientOriginalExtension();
    
            $name = time().'.'.$ext;
    
            $path = 'contracts-pdf/';
    
            $img->move($path, $name);

            $saved_file = $name;

        }

        $status = $contract->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'party' => $request->party,
            'category_id' => $request->category_id,
            'start_date' => $request->start_date,
            'send_date' => $request->end_date,
            'contract_pdf' => $saved_file,
         ]);

         if( !$status ){
             return redirect()->back()->with('error', 'fail to save changes...');
         }
         return redirect()->back()->with('success', 'Contract saved Successfully...');

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
