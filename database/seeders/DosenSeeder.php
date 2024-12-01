<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        Dosen::query()->delete();
        foreach (range(1, 10) as $index) {
            Dosen::create([
                'email' => $faker->unique()->safeEmail,
                'nama' => $faker->name,
                'password' => Hash::make('123qwe'),
            ]);
        }
    }
}
