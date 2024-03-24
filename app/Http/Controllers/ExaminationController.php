<?php

namespace App\Http\Controllers;

use App\Models\ExamModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExaminationController extends Controller
{
    public function exam_list()
    {
        $data['header_title'] = 'Admin List';
        $data['getExamRecords'] = ExamModel::getExamRecord();
        return view('admin.examinations.exam.list', $data);
    }

    public function exam_create()
    {
        $data['header_title'] = 'Add New Exam';
        return view('admin.examinations.exam.add', $data);
    }

    public function exam_insert(Request $request)
    {
        $exam = new ExamModel();
        $exam->name = $request->name;
        $exam->note = $request->note;
        $exam->created_by = Auth::user()->id;
        $exam->save();

        toastr()->addsuccess('Exam Successfully Created');
        return redirect()->route('admin.examinations.exam.list');
    }

    public function exam_edit($exam_id)
    {
        $data['getExamRecord'] = ExamModel::find($exam_id);
        if (!empty($data['getExamRecord'])) {
            $data['header_title'] = 'Edit Exam';
            return view('admin.examinations.exam.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function exam_update(Request $request, $exam_id)
    {
        $exam = ExamModel::find($exam_id);
        $exam->name = $request->name;
        $exam->note = $request->note;
        $exam->save();

        toastr()->addsuccess('Exam Successfully Updated');
        return redirect()->route('admin.examinations.exam.list');
    }

    
    public function exam_destroy($exam_id)
    {
        $exam = ExamModel::find($exam_id);
        if(!empty($exam))
        {
            $exam->is_delete = 1;
            $exam->save();
            toastr()->addsuccess('Exam Successfully Deleted');
            return redirect()->route('admin.examinations.exam.list');
        }
        else
        {
            abort(404);
        }
    }
}
