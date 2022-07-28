<?php

namespace Database\Seeders;

use App\Enums\InstitutionType;
use Illuminate\Database\Seeder;
use App\Enums\InstitutionSubType;
use App\Models\Hospital;
use App\Models\School;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SanjiwaniSeeder extends Seeder
{
    private $hospitalId = 1;

    public function run()
    {
        DB::table('hospitals')->insert([
            'id' => $this->hospitalId,
            'name' => 'Sanjiwani, RS',
        ]);

        $stations = [
            100 => 'Bedah',
            101 => 'Obgyn',
            102 => 'Anak',
            103 => 'Interna',
            104 => 'Neurologi',
            105 => 'Dermatovenerology',
            106 => 'THT',
            107 => 'Mata',
            108 => 'Jiwa',
            109 => 'Anestesi',
            110 => 'Radiologi',
            111 => 'Paru',
        ];
        foreach ($stations as $id => $name) {
            DB::table('stations')->insert([
                'id' => $id,
                'name' => $name,
                'hospital_id' => $this->hospitalId,
            ]);
        }

        $this->createStationScheduleSetting();

        School::factory()->create([
            'name' => 'SMK 1',
        ]);

        /** @var Institution */
        $school = school::factory()->create([
            'name' => 'Warmadewa, Universitas',
        ]);
    }

    public function createStationScheduleSetting()
    {
        // koas
        // Bedah; selama 10 minggu:
        // Obgyn: selama 10 minggu:
        // Anak; selama 10 minggu:
        // Interna:  selama 10 minggu:
        // Neurologi: selama 8 minggu:
        // Dermatovenerology:   selama 6 minggu
        // THT: selama 6 minggu;
        // Mata: selama 6 minggu;
        // Jiwa: selama 6 minggu;
        // Anestesi: 4 minggu:
        // Radiologi: 4 minggu:
        $koasScheduleWeek = [
            100 => 10,
            101 => 10,
            102 => 10,
            103 => 10,
            104 => 8,
            105 => 6,
            106 => 6,
            107 => 6,
            108 => 6,
            109 => 4,
            110 => 4,
        ];
        $setting = Setting::where('key', Setting::KOAS_SCHEDULE_WEEK)->first();
        $setting->value = json_encode($koasScheduleWeek);
        $setting->save();
    }
}
