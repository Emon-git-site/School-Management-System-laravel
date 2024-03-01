<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Admin List';
        $data['admins'] = User::where('user_type', 1)->where('is_delete', 0)->latest()->get();
        return view('admin.admin.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add new Admin';
        return view('admin.admin.add', $data);
    }

    public function insert(Request $request)
    {
        // dd($request->all());
        $user = User::make($request->except('password'));
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();
        toastr()->addsuccess('Admin Successfully Created');
        return redirect()->route('admin.admin.list');
    }

    public function edit($id)
    {
        $data['admin'] = User::where('user_type', 1)->where('id', $id)->first();
        if(!empty($data['admin']))
        {
            $data['header_title'] = "Edit New Admin";
            return view('admin.admin.edit', $data);
        }
        else
        {
            abort(404);
        }
    }
    public function update(Request $request ,User $admin)
    {
        // $admin = User::find($id);
        $admin->fill($request->except('password'));
        $admin->password = Hash::make($request->password);
        $admin->update();

        toastr()->addsuccess('Admin  Information Updated Successfully ');
        return redirect()->route('admin.admin.list');
    }

    public function destroy(User $admin)
    {
        $admin->is_delete = 1;
        $admin->save();
        toastr()->addsuccess('Admin Successfully Deleted');
        return redirect()->route('admin.admin.list');
    }
}
