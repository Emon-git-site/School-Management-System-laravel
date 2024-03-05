<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function change_passwordShow()
    {
        $data['header_title'] = "Change Password";
        return view('profile.change_password', $data);
    }
    public function change_passwordUpdate(Request $request)
    {
        // dd('sflk');
        $user = Auth::user();
        if(Hash::check($request->old_password, $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();

            toastr()->addsuccess('Password Updated Successfully ');
            return redirect()->back();
        }
        else
        {
            toastr()->adderror('Old Password is not correct. ');
            return redirect()->back();
        }
    }
}
