<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Classe;
use Illuminate\Http\Request;
use App\Models\admin\Subject;
use App\Models\admin\Class_subject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Class_subjectController extends Controller
{
    public function list()
    {
        $data['class_subjects'] = Class_subject::getClassSubject();
        $data['header_title'] = 'Assign Subject List';
        return view('admin.assign_subject.list', $data);
    }

    
    public function add()
    {
        $data['getClass'] = Classe::getClassAssign();
        $data['getSubject'] = Subject::getSubjectAssign();
        $data['header_title'] = 'Add new Assign Subject';
        return view('admin.assign_subject.add', $data);
    }

    public function insert(Request $request)
    {
        if(!empty($request->subject_id))
        {
            foreach($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = Class_subject::getAlreadyFirst($request->class_id, $subject_id);
                if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else
                {
                    $class_subject = new Class_subject;
                    $class_subject->classe_id = $request->class_id;
                    $class_subject->subject_id = $subject_id;
                    $class_subject->status = $request->status;
                    $class_subject->created_by = Auth::user()->id;
                    $class_subject->save();
                }

            } 
            toastr()->addsuccess('Subject Successfully Assign to  Class');
            return redirect()->route('admin.assign-subject.list');
        }
        else
        {
            toastr()->adderror('Due to some error pls try again');
            return redirect()->back();
        }
    }

    public function edit()
    {
        $data['getClass'] = Classe::getClassAssign();
        $data['getSubject'] = Subject::getSubjectAssign();
        $data['header_title'] = 'Edit Assign Subject';
        return view('admin.assign_subject.edit', $data);
    }

    
    public function destroy(Class_subject $class_subject)
    {
        $class_subject->is_delete = 1;
        $class_subject->save();
        toastr()->addsuccess('Assign Class Successfully Deleted');
        return redirect()->route('admin.assign-subject.list');
    }
}
