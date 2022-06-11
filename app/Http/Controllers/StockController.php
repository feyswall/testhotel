<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        return view('admin.stock.index');
    }
}
