<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchasesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        return view('admin.purchases.index');
    }
}
