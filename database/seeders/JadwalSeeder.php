<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // mengambil id dari tabel dosen dan matakuliah
        $dosenIds = Dosen::pluck('id')->toArray();
        $matakuliahIds = Matakuliah::pluck('id')->toArray();

        // Memastikan tabel dosen dan matakuliah tidak kosong
        if (empty($dosenIds) || empty($matakuliahIds)) {
            $this->command->error('Tabel dosen atau matakuliah kosong. Tambahkan data terlebih dahulu.');
            return;
        }

        Jadwal::query()->delete();

        // Buat data dummy untuk tabel jadwal
        foreach (range(1, 10) as $index) {
            Jadwal::create([
                'dosen_id' => $faker->randomElement($dosenIds), // Ambil ID dosen secara acak
                'matakuliah_id' => $faker->randomElement($matakuliahIds), // Ambil ID matakuliah secara acak
                'hari' => $faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
                'jam_mulai' => $faker->time('H:i:s', '08:00:00'), // Jam mulai
                'jam_selesai' => $faker->time('H:i:s', '17:00:00'), // Jam selesai
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
