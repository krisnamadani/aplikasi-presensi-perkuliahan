<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Presensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua id dari tabel jadwal dan dosen
        $jadwalIds = Jadwal::pluck('id')->toArray();
        $dosenIds = Dosen::pluck('id')->toArray();

        // Pastikan tabel jadwal dan dosen tidak kosong
        if (empty($jadwalIds) || empty($dosenIds)) {
            $this->command->error('Tabel jadwal atau dosen kosong. Tambahkan data terlebih dahulu.');
            return;
        }

        Presensi::query()->delete();

        // Buat data dummy untuk tabel presensi
        foreach (range(1, 10) as $index) {
            Presensi::create([
                'jadwal_id' => $faker->randomElement($jadwalIds), // Ambil ID jadwal secara acak
                'dosen_id' => $faker->randomElement($dosenIds), // Ambil ID dosen secara acak
                'waktu_presensi' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'), // Waktu presensi acak
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
