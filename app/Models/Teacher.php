<?php

namespace App\Models;

use App\Enums\TeachingType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $casts = [
        'teaching_type' => TeachingType::class,
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
