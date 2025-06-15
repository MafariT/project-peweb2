<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jadwal;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            Jadwal::factory(10)->create([
                'user_id' => $user->id,
            ]);
        });

        User::factory()->create([
            'role' => 'admin',
            'name' => 'Admin Sistem',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('admin'),
        ]);
    }
}
