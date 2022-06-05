<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    /**
    * @param $id of the iser
    * @return 
    * madeIn jun 4 2022
    */
    public function updateProfile(Request $request, $id){
        $user = $this->getUserObject($id);
        if( !$user ){
            return redirect()->back()
            ->withErrors(['error' => 'requested user not found']);
        }else{
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'user_name' => 'required',
            ];
            if( $request->password ){
                if( Hash::check($user->password, $request->password) ){
                    dd('password match');
                }
            }
            $request->validate($rules);
        }
    }


    /**
     * @param $id of the iser
     * @return null or User object
     * madeIn jun 3 2022
     */
    public function getProfile($id){
        $user = $this->getUserObject($id);
        if( $user ) {
            return view('admin.profile', compact('user'));
        }else{
            return redirect()->back()
            ->withErrors(['error' => 'requested user was not found']);
        }
    }




    /**
     * @param $id of the iser
     * @return null or User object
     * madeIn jun 3 2022
     */
    private function getUserObject($id){
        $user = User::where('id', '=', $id)->first();
        return $user ? $user : null;
    }
}
