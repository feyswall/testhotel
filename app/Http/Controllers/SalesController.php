<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');    
    }

    function index(){
        return view('admin.sales.index');
    }
}
