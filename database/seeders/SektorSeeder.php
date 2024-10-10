<?php

namespace Database\Seeders;

use App\Models\Sektor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SektorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sektor::create([
            'image' => 'sektor1.jpg',
            'name' => 'Sektor Pendidikan',
            'description' => 'Mendukung proyek-proyek yang berhubungan dengan sektor pendidikan.',
        ]);

        Sektor::create([
            'image' => 'sektor2.jpg',
            'name' => 'Sektor Kesehatan',
            'description' => 'Proyek yang berfokus pada kesehatan masyarakat.',
        ]);

        Sektor::create([
            'image' => 'sektor3.jpg',
            'name' => 'Sektor Teknologi',
            'description' => 'Proyek yang melibatkan teknologi dan inovasi.',
        ]);
    }
}
