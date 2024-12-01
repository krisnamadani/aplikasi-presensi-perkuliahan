<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        Matakuliah::query()->delete();
        foreach (range(1, 10) as $index) {
            Matakuliah::create([
                'kode_matakuliah' => strtoupper($faker->lexify('???') . $faker->numerify('###')), // Kode unik
                'nama' => $faker->words(3, true), // Nama mata kuliah
                'sks' => $faker->numberBetween(1, 4), // SKS (1-4)
                'jenis' => $faker->randomElement(['Teori', 'Praktikum']), // Jenis mata kuliah
            ]);
        }
    }
}
