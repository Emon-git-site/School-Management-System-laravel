<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        // dd(Hash::make('1'));
        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect()->route('admin.dashboard');
            }
            else if(Auth::user()->user_type == 2)
            {
                return redirect()->route('teacher.dashboard');
            }
            else if(Auth::user()->user_type == 3)
            {
                return redirect()->route('student.dashboard');
            }
            else if(Auth::user()->user_type == 4)
            {
                return redirect()->route('parent.dashboard');
            }
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember)? true: false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect()->route('admin.dashboard');
            }
            else if(Auth::user()->user_type == 2)
            {
                return redirect()->route('teacher.dashboard');
            }
            else if(Auth::user()->user_type == 3)
            {
                return redirect()->route('student.dashboard');
            }
            else if(Auth::user()->user_type == 4)
            {
                return redirect()->route('parent.dashboard');
            }

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
