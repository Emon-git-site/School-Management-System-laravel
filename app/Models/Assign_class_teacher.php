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
            ->join('users', 'users.id', 'assign_class_teachers.created_by')
            ->orderBy('assign_class_teachers.id', 'desc')
            ->where('assign_class_teachers.is_delete', 0)
            ->where('classes.is_delete', 0)
            ->where('classes.status', 0)
            ->paginate(4 );

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
