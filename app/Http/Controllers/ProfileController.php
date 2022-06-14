<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Svg\Tag\Rect;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function profile(){
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    function update_details(Request $request, $id){
        $data = User::find($id);

        $inputs = $request->all();
        $update = $data->update($inputs);

        if ($update) {
            return redirect()->back();
        }
    }

    function password_udpate(Request $request, $id){
        if(Hash::check($request->oldpassword, Auth::user()->password) ){
            if($request->password == $request->password_confirmation){
               $change =  User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->password)]);
                if($change){
                    return redirect()->back();
                }
            } else{
                return response()->json(['error' => "Password do not Match"]);
            }
        }
        else
        {
            return response()->json(['error' => "Oooops..!Wrong Old Password"]);
         }
    }
}
