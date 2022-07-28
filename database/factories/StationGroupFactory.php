<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Station;
use App\Models\Enums\StationGroupStatus;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class StationGroupFactory extends Factory
{
    public function definition()
    {
        return [
            'group_id' => Group::factory(),
            'station_id' => Station::factory(),
            'teacher_id' => Teacher::factory(),
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'status' => StationGroupStatus::New,
        ];
    }
}
