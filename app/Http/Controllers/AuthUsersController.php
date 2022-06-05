<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthUsersController extends Controller
{
    

        /**
     * @param request Object
     * @return dashboard view
     * madeIn jun 4 2022
     */
    public function login(Request $request){

        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        if( !Auth::attempt( ['email' => $request->email, 'password' => $request->password ]) ){
            $request->session()->regenerate();
            return redirect()->back()->withErrors([
                'error' => 'Wrong email or password',
            ]);
        }else{
            return 'first attempt';
        }


    }

    public function logout(){

    //     Auth::guard('web')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/login');
    Session::flush();
    Auth::logout();
    return redirect('login');
    }
}
