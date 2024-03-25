<?php

namespace App\Http\Controllers;

use App\Models\ExamModel;
use Illuminate\Support\Arr;
use App\Models\admin\Classe;
use Illuminate\Http\Request;
use App\Models\ExamSchedulModel;
use App\Models\admin\Class_subject;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\Class_subjectController;

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

    public function exam_schedule(Request $request)
    {
        $data['getClass'] = Classe::getClass();
        $data['getExam'] = ExamModel::getExam();
        $result = array();
        if(!empty(Request('exam_id')) && !empty(Request('class_id')))
        {
            $class_Subjects = Class_subject::mySubjectName(Request('class_id'));
               foreach($class_Subjects as $class_Subject)
               {
                $dataS = array();
                $dataS['subject_id'] = $class_Subject->subject_id;
                $dataS['class_id'] = $class_Subject->classe_id;
                $dataS['subject_name'] = $class_Subject->subject_name;
                $dataS['subject_type'] = $class_Subject->subject_type;

                $exam_schedule = ExamSchedulModel::getRecordSingle($request('exam_id'), $request('class_id'), $request('subject_id'))

                $result[] = $dataS;
               }
        }
        $data['class_subjects'] = $result;
        $data['header_title'] = 'Exam Schedule';
        return view('admin.examinations.exam_schedule', $data);
    }

    public function exam_schedule_insert(Request $request)
    {
        if(!empty($request->schedule))
        {
            foreach($request->schedule as $schedule)
            {
                if(!empty($schedule['subject_id']) && !empty($schedule['exam_date']) && 
                !empty($schedule['start_time']) && !empty($schedule['end_time']) &&
                !empty($schedule['room_number']) && !empty($schedule['full_marks']) &&
                !empty($schedule['passing_marks']))
                {
                    $exam_schedule = ExamSchedulModel::create([
                        'exam_id' => $request->exam_id,
                        'class_id' => $request->class_id,
                        'subject_id' => $schedule['subject_id'],
                        'exam_date' => $schedule['exam_date'],
                        'start_time' => $schedule['start_time'],
                        'end_time' => $schedule['end_time'],
                        'room_number' => $schedule['room_number'],
                        'full_marks' => $schedule['full_marks'],
                        'passing_marks' => $schedule['passing_marks'],
                        'created_by' => Auth::user()->id
                    ]);
                }
            }
            toastr()->addsuccess('Exam Schedule Successfully Saved');
            return redirect()->back();
        }
    }
}
