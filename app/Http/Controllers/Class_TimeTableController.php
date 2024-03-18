<?php

namespace App\Http\Controllers;

use App\Models\WeekModel1;
use App\Models\admin\Classe;
use Illuminate\Http\Request;
use App\Models\admin\Class_subject;

class Class_TimeTableController extends Controller
{
    public function list(Request $request)
    {
        if(!empty($request->class_id))
        {
            $data['getSubject'] = Class_subject::mySubjectName($request->class_id);
        }

        $getWeeks = WeekModel1::getWeekRecord();
        $week = array();
        foreach($getWeeks as $getWeek)
        {
            $dataW = array();
            $dataW['week_id'] = $getWeek->id;
            $dataW['week_name'] = $getWeek->name;
            $week[] = $dataW;
        }
        $data['weeks'] = $week;
        $data['getClass'] = Classe::getClass();
        $data['header_title'] = 'Class Timetable List';
        return view('admin.class_timetable.list', $data);
    }


    public function get_subject(Request $request)
    {
        $getSubject = Class_subject::mySubjectName($request->class_id);
        $html = "<option value=''>Select Subject</option>";
    
        foreach($getSubject as $subject)
        {
            $html .= "<option value='".$subject->subject_id."'>".$subject->subject_name."</option>";
        }
    
        $json['html'] = $html;
    
        return response()->json($json);
    }
    

}
;