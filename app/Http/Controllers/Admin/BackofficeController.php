<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackofficeController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        return view('admin.back_office.index');
    }
}
