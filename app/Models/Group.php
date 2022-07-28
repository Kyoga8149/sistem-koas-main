<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Station;
use App\Models\Teacher;
use App\Enums\StudyType;
use App\Models\StationGroup;
use App\Models\Enums\GroupStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $casts = [
        'study_type' => StudyType::class,
        'status' => GroupStatus::class,
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected $attributes = [
        'study_type' => StudyType::Clerkship,
        'status' => GroupStatus::New,
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function stationGroups()
    {
        return $this->hasMany(StationGroup::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

   
}
