<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackOfficeController extends Controller
{
    public function landing_page(){
        return view('admin.back_office.landing_page');
    }

    function employees(){
        return view('admin.back_office.employees');
    }

    function categories($type){
        return view('admin.back_office.categories')->with('type', $type);
    }

    function suppliers(){
        return view('admin.back_office.suppliers');
    }

    function taxes(){
        return view('admin.back_office.taxes');
    }

    function customers(){
        return view('admin.back_office.customers');
    }

    function discounts(){
        return view('admin.back_office.discounts');
    }

    function attributes(){
        return view('admin.back_office.attributes');
    }

    function users(){
        return view('admin.back_office.users');
    }
}
