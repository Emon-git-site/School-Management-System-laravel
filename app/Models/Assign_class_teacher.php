<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign_class_teacher extends Model
{
    use HasFactory;

    protected $table = 'assign_class_teachers';

    static public function getSingle($class_teacher_id)
    {
        return self::find($class_teacher_id);
    }

    static public function getAssignTeacherID($class_id)
    {
        return self::where('classe_id', $class_id)
            ->where('is_delete', 0)->get();
    }

    static public  function getClassTeacher()
    {
        $return = self::select('assign_class_teachers.*', 'classes.name as class_name', 'teacher.name as teacher_name', 'users.name as created_by_name')
            ->join('users as teacher', 'teacher.id', 'assign_class_teachers.teacher_id')
            ->join('classes', 'classes.id', 'assign_class_teachers.classe_id')
            ->join('users', 'users.id', 'assign_class_teachers.created_by');
        if (!empty(request('teacher_name'))) {
            $teacher_name = request('teacher_name');
            $return = $return->where('teacher.name', 'like', '%' . $teacher_name . '%');
        }
        if (!empty(request('class_name'))) {
            $class_name = request('class_name');
            $return = $return->where('classes.name', 'like', '%' . $class_name . '%');
        }
        if (request()->has('status') && request('status') !== null) {
            $status = request('status');
            $return = $return->where('assign_class_teachers.status', $status);
        }

        if (!empty(request('date'))) {
            $date = request('date');
            $return = $return->whereDate('users.created_at', $date);
        }
        $return = $return->orderBy('assign_class_teachers.id', 'desc')
            ->where('assign_class_teachers.is_delete', 0)
            ->where('classes.is_delete', 0)
            ->where('classes.status', 0)
            ->paginate(4);

        return $return;
    }

    static public function getAlreadyFirst($class_id, $teacher_id)
    {
        return self::where('classe_id', $class_id)->where('teacher_id', $teacher_id)->first();
    }


    static public function deleteTeacher($class_id)
    {
        return self::where('classe_id', $class_id)->delete();
    }
}
