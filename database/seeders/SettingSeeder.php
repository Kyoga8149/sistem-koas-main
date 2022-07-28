<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create schedule

        $koasSetting = new Setting([
            'key' => Setting::KOAS_SCHEDULE,
            'value' => '{"start": "08:00", "end": "17:00"}',
        ]);
        $koasSetting->save();
    }
}
