<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employees.index', [
            'employees' => $employees,
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
        $validate = Validator::make($request->all(), [
            'name' => 'unique:employees,name|required|string',
            'salary' => 'sometimes|numeric',
        ])->validate();

        $employee = Employee::create([
            'name' => $request->name,
            'salary' => $request->salary,
        ]);

        if( !$employee ){
            return redirect()->back()->with('error', 'Fail registering user...')->withInput();
        }
        return redirect()->back()->with('success' , 'Employee Created Successfully...');
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
        $employee = Employee::where('id', $id)->first();
   
        return view( 'admin.employees.edit',
            [ 'employee' => $employee ]);
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

        $employee = Employee::find($id);
         if( !$employee ){
            return redirect()->back()->with('error', 'Fail to update Employe...');
        }

        $rules = [
            'salary' => 'sometimes|numeric',
        ];
        if( $request->name != $employee->name ){
            $rules['name'] = 'required|unique:employees,name|string'; 
        }else{
            $rules['name'] = 'required|string';
        }


        $employee = Employee::find($id);
            if( !$employee ){
                return redirect()->back()->with('error', 'Fail to update Employe...');
        }

        $validate = Validator::make($request->all(), $rules)->validate();

        $status = $employee->update([
           'name' => $request->name,
           'salary' => $request->salary, 
        ]);

        if( $status ){
            return redirect()->back()->with('success', 'data saved successfully..');
        }else{
            return redirect()->back()->with('error', 'fail to save data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('delete user');
    }
}
