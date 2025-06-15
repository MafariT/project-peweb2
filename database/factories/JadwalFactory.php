<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class JadwalFactory extends Factory
{
    public function definition(): array
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        $startHour = $this->faker->numberBetween(7, 16);
        $startMinute = $this->faker->randomElement([0, 15, 30, 45]);
        $jamMulai = sprintf('%02d:%02d', $startHour, $startMinute);

        $duration = $this->faker->numberBetween(1, 3);
        $jamSelesai = date('H:i', strtotime("$jamMulai +{$duration} hours"));

        if (strtotime($jamSelesai) > strtotime('18:00')) {
            $jamSelesai = '18:00';
        }

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'mata_kuliah' => $this->faker->randomElement([
                'Pemrograman Web', 'Sistem Operasi', 'Struktur Data', 'Basis Data', 'Jaringan Komputer'
            ]),
            'dosen' => $this->faker->name(),
            'ruangan' => 'R' . $this->faker->numberBetween(001, 100),
            'hari' => $this->faker->randomElement($days),
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
        ];
    }
}
