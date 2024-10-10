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
            SektorSeeder::class,
            ProjectSeeder::class,
            LaporanSeeder::class,
            KegiatanSeeder::class,
            TagSeeder::class,
        ]);
    }
}
