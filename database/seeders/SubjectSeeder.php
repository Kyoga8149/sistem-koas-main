<?php

namespace Database\Seeders;

use App\Enums\StudyType;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = [
            'Kompetensi Buku Log',
            'Tutorial Klinik',
            'Refleksi Kasus',
            'Laporan Kasus',
            'Journal Reading',
            'Mini Ce-X',
            'Ujian Lisan',
            'Nilai Akhir',
        ];
        foreach ($titles as $title) {
            Subject::factory()->create([
                'name' => $title,
                'study_type' => StudyType::Clerkship,
            ]);
        }
    }
}
