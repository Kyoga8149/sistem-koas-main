<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $casts = [
        'grade_deadline' => 'date',
        'status' => GradeStatus::class,
    ];

    public function assignedStation()
    {
        return $this->belongsTo(StationGroup::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

enum GradeStatus: string
{
    case New = 'new';
    case Grading = 'grading';
    case Done = 'done';
}
