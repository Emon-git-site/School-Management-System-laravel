<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\admin\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Student List';
        $data['students'] = User::getStudent();
        return view('admin.student.list', $data);
    }

    public function add()
    {
        $data['getClassAssigns'] = Classe::getClassAssign();
        $data['header_title'] = 'Add New Student';
        return view('admin.student.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'weight' => 'max:10',
            'blood_group' => 'max:10',
            // do more validation later
        ]);
        $user = User::make($request->except('password', 'profie_pic'));
        $user->password = Hash::make($request->password);
        if(!empty($request->file('profile_pic')))
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $destinationPath = public_path('upload/profile');
            $file->move($destinationPath, $filename);
            $user->profile_pic = $filename;
        }
        $user->save();
        toastr()->addsuccess('Student Successfully Created');
        return redirect()->route('admin.student.list');
    }
}
