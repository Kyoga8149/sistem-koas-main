<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admin = User::factory()->create([
            'name' => 'Made Adi',
            'email' => 'made.adi@taksu.tech',
        ]);
        Admin::factory()->create([
            'user_id' => $admin->id,
        ]);

        User::factory()->create([
            'name' => 'Made Adi @ Gmail',
            'email' => 'made.adi@gmail.com',
        ]);
    }
}
