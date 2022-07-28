<?php

namespace App\Models;

use App\Enums\StudyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    public $casts = [
        'study_type' => StudyType::class,
    ];

    use HasFactory;
}
