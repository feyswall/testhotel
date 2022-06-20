<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $categories = Category::where('type', $type)->get();
        return view('admin.categories.index')->with([
            'type' => $type,
            'categories' => $categories
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
            'name' => 'required|unique:categories,name',
            'desc' => 'required',
            'type' => 'required'
        ];

        Validator::make($request->all(), $rules)->validate();

        $category = Category::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'type' => $request->type
        ]);

        if( !$category ){
            return redirect()->back()->with('error', 'fail to create object');
        }
        return redirect()->back()->with('success', 'New category created..');;;
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


        $category = Category::find($id);
        if(!$category){
            return redirect()->back()->with('error', 'Category not found!');
        }

        if( $request->name != $category->name ){
            $rules = [
            'name' => 'required|unique:categories,name',
            'desc' => 'required',
        ];
        }else{
            $rules = [
            'name' => 'required',
            'desc' => 'required',
        ];
        }

        Validator::make($request->all(), $rules)->validate();

        $category->name = $request->name;
        $category->desc = $request->desc;
        $category->save();

        return redirect()->back()->with('success', 'Category updated..');
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
