<?php

namespace App\Http\Controllers;

use App\Models\WeekModel1;
use Illuminate\Http\Request;
use App\Models\admin\Class_subject;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSubjectTimetable;

class CalendarController extends Controller
{
    public function myCalendar()
    {
        $result = array();
        $mySubjects = Class_subject::mySubjectName(Auth::user()->classe_id);
        foreach($mySubjects as $mySubject)
        {
            $dataS['subject_name'] = $mySubject->subject_name;
            $getWeeks = WeekModel1::getWeekRecord();
            $week = array();
            foreach($getWeeks as $getWeek)
            {
                $dataW = array();
                $dataW['week_name'] = $getWeek->name;
                $dataW['fullcalendar_day'] = $getWeek->fullcalendar_day;
                $class_subject = ClassSubjectTimetable::getRecordClassSubject($mySubject->classe_id, $mySubject->subject_id, $getWeek->id);
                if(!empty($class_subject))
                {
                    $dataW['start_time'] = $class_subject->start_time;
                    $dataW['end_time'] = $class_subject->end_time;
                    $dataW['room_number'] = $class_subject->room_number;
                    $week[] = $dataW;
                }
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        $data['getMyTimetable'] = $result;
        $data['header_title'] = 'My Calendar';
        return view('student.my_calendar', $data);
    }
}
