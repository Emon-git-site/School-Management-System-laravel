<?php

namespace App\Http\Controllers;

use App\Models\admin\Classe;
use Illuminate\Http\Request;

class Class_TimeTableController extends Controller
{
    public function list()
    {
        $data['getClass'] = Classe::getClass();
        $data['header_title'] = 'Class Timetable List';
        return view('admin.class_timetable.list', $data);
    }

}
