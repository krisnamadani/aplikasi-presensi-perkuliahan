<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use Carbon\Carbon;
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

        // Ambil semua mata kuliah dan dosen
        $matakuliah = Matakuliah::all();
        $dosen = Dosen::all();

        // Batasi data menjadi 10 jadwal
        foreach (range(1, 10) as $index) {
            // Pilih mata kuliah dan dosen secara acak
            $mk = $matakuliah->random();
            $dsn = $dosen->random();

            // Tentukan durasi berdasarkan jenis mata kuliah
            if ($mk->jenis == 'Teori') {
                $durasi = 55; // 55 menit untuk teori
            } elseif ($mk->jenis == 'Praktikum') {
                $durasi = 120; // 120 menit untuk praktikum
            } else {
                $durasi = 60; // Default durasi jika jenis tidak ditemukan
            }

            // Tentukan waktu mulai secara acak (misalnya dari jam 7 pagi hingga 3 sore)
            $jamMulai = Carbon::createFromFormat('Y-m-d H:i:s', $faker->dateTimeThisMonth('now', 'Asia/Jakarta')->format('Y-m-d H:i:s'))->setTime(
                rand(7, 14), // Jam mulai acak antara jam 7 sampai jam 14
                $faker->numberBetween(0, 59) // Menit mulai acak
            );

            // Hitung waktu selesai berdasarkan durasi
            $jamSelesai = $jamMulai->copy()->addMinutes($durasi); // Menambahkan durasi ke jam mulai

            // Simpan data jadwal
            Jadwal::create([
                'dosen_id' => $dsn->id,
                'matakuliah_id' => $mk->id,
                'hari' => $faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
                'jam_mulai' => $jamMulai->format('H:i'), // Format jam mulai
                'jam_selesai' => $jamSelesai->format('H:i'), // Format jam selesai
            ]);
        }
    }
}
