<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\admin\Subject;
use App\Http\Controllers\Controller;
use App\Models\admin\Class_subject;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list()
    {
        $data['subjects'] = Subject::getSubject();
        $data['header_title'] = 'Subject List';
        return view('admin.subject.list', $data);
    }

    
    public function add()
    {
        $data['header_title'] = 'Add new Subject';
        return view('admin.subject.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required|string|max:255'
        ]);

        $subject = Subject::make($request->except('created_by'));
        $subject->created_by = Auth::user()->id;
        $subject->save();
        toastr()->addsuccess('Subject Successfully Created');
        return redirect()->route('admin.subject.list');
    }

    
    public function edit($id)
    {
        $data['subject'] = Subject::where('id', $id)->first();
        if(!empty($data['subject']))
        {
            $data['header_title'] = "Edit Subject";
            return view('admin.subject.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update(Request $request ,Subject $subject)
    {
        request()->validate([
            'name' => 'required|string|max:255'
        ]);
        $subject->update($request->all());
        toastr()->addsuccess('Subject  Information Updated Successfully ');
        return redirect()->route('admin.subject.list');
    }

    
    public function destroy(Subject $subject)
    {
        $subject->is_delete = 1;
        $subject->save();
        toastr()->addsuccess('Subject Successfully Deleted');
        return redirect()->route('admin.subject.list');
    }

    // student part
    public function MySubject()
    {
        $data['mySubjects'] = Class_subject::mySubjectName(Auth::user()->classe_id);
        $data['header_title'] = 'My Subject';
        return view('student.my_subject', $data);
    }
}
