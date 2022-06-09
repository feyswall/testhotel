<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackOfficeController extends Controller
{
public function landing_page(){
    return view('admin.back_office.landing_page');
}
}
