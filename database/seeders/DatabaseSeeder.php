<?php

namespace Database\Seeders;

use App\Models\ImageLaporan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MitraSeeder::class,
            ProjectSeeder::class,
            SektorSeeder::class,
            LaporanSeeder::class,
            ImageLaporan::class,
            KegiatanSeeder::class,
            TagSeeder::class,
        ]);
    }
}
