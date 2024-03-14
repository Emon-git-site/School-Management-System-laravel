<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\admin\Classe;
use Illuminate\Http\Request;
use App\Models\admin\Subject;
use App\Models\Assign_class_teacher;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function list()
    {
        $data['class_teachers'] = Assign_class_teacher::getClassTeacher();
        $data['header_title'] = 'Assign Class Teacher';
        return view('admin.assign_class_teacher.list', $data);
    }

    public function add()
    {
        $data['getClassAssign'] = Classe::getClassAssign();
        $data['getSubjectAssign'] = Subject::getSubjectAssign();
        $data['teachers'] = User::getTeacher();
        $data['header_title'] = 'Add Assign Class Teacher';
        return view('admin.assign_class_teacher.add', $data);
    }

    public function insert(Request $request)
    { 
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                $getAlreadyFirst = Assign_class_teacher::getAlreadyFirst($request->class_id, $teacher_id);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                 else {
                    $assign_class_teacher = new Assign_class_teacher;
                    $assign_class_teacher->classe_id = $request->classe_id;
                    $assign_class_teacher->teacher_id = $teacher_id;
                    $assign_class_teacher->status = $request->status;
                    $assign_class_teacher->created_by = Auth::user()->id;
                    $assign_class_teacher->save();
                }
            }
            toastr()->addsuccess('Assign Class to Teacher Successfully');
            return redirect()->route('admin.assign_class_teacher.list');
        } else {
            toastr()->adderror('Due to some error pls try again');
            return redirect()->back();
        }
    }
}
