<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enums\StationGroupStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StationGroup extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => StationGroupStatus::class,
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected $attributes = [
        'status' => StationGroupStatus::New,
    ];

    protected $fillable = [
        'group_id',
        'station_id',
        'teacher_id',
        'start_date',
        'end_date',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
