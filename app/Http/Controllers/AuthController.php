<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if(!empty(Auth::check()))
        {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember)? true: false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            toastr()->adderror('Please Enter Correct Email and Password. ');
            return redirect()->back();
        }
    }

    public function AuthLogout()
    {
        Auth::logout();
        return redirect(url('/'));
    }
}
