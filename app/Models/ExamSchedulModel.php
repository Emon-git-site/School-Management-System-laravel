<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedulModel extends Model
{
    use HasFactory;
    
    protected $table = 'exam_schedule';
    protected $fillable = [
        'exam_id', 
        'class_id',
        'subject_id',
        'exam_date',
        'start_time',
        'end_time',
        'room_number',
        'full_marks',
        'passing_marks',
        'created_by'
    ];

    static public function getRecordSingle($exam_id, $class_id, $subject_id)
    {
        return self::where('exam_id', $exam_id)->where('class_id', $class_id)->where('subject_id', $subject_id)->first();
    }

    static public function deleteRecord($exam_id, $class_id)
    {
        self::where('exam_id', $exam_id)->where('class_id', $class_id)->delete();
    }
}
