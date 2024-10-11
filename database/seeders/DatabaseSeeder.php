<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MitraSeeder::class,
            SektorSeeder::class,
            ProjectSeeder::class,
            LaporanSeeder::class,
            KegiatanSeeder::class,
            TagSeeder::class,
        ]);
    }
}
