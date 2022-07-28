<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Student;
use App\Enums\StudyType;
use Illuminate\Database\Seeder;
use App\Models\School;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school = School::first();

        // students
        /** @var Group */
        $koas1 = Group::factory()->create([
            'name' => 'Koas Group 1',
            'study_type' => StudyType::Clerkship,
            'school_id' => $school->id,
        ]);

        Student::factory()->count(10)->create([
            'group_id' => $koas1->id,
        ]);
    }
}
