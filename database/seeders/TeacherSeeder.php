<?php

namespace Database\Seeders;

use App\Models\Station;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for every station,
        // create a teacher
        /** @var Collection $stations */
        $stations = Station::all();
        $stations->each(function (Station $station) {
            $station->teachers()->save(Teacher::factory()->make());
        });
    }
}
