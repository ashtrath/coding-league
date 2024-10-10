<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Sektor;

class SektorSeeder extends Seeder
{
    public function run(): void
    {
        $sektors = [
            [
                'name' => 'Sosial',
                'image' => 'sosial.jpg',
                'description' => 'Sektor yang fokus pada pembangunan infrastruktur.'
            ],
            [
                'name' => 'Pendidikan',
                'image' => 'pendidikan.jpg',
                'description' => 'Sektor yang berkaitan dengan pengembangan teknologi.'
            ],
            [
                'name' => 'Lingkungan',
                'image' => 'lingkungan.jpg',
                'description' => 'Sektor yang berfokus pada peningkatan kualitas pendidikan.'
            ],
            [
                'name' => 'Kesehatan',
                'image' => 'kesehatan.jpg',
                'description' => 'Sektor yang berfokus pada peningkatan kualitas pendidikan.'
            ],
            [
                'name' => 'Infarastruktur dan sanitasi lingkungan',
                'image' => 'infarastruktur dan sanitasi lingkungan.jpg',
                'description' => 'Sektor yang berfokus pada peningkatan kualitas pendidikan.'
            ],
            [
                'name' => 'Sarana dan prasarana keagamaan',
                'image' => 'sarana dan prasarana keagamaan.jpg',
                'description' => 'Sektor yang berfokus pada peningkatan kualitas pendidikan.'
            ],
            [
                'name' => 'Kerapihan',
                'image' => 'lingkungan.jpg',
                'description' => 'Sektor yang berfokus pada peningkatan kualitas pendidikan.'
            ],
            [
                'name' => 'Kedisiplinan',
                'image' => 'kedisiplinan.jpg',
                'description' => 'Sektor yang berfokus pada peningkatan kualitas pendidikan.'
            ],
            [
                'name' => 'Keasrian',
                'image' => 'keasrian.jpg',
                'description' => 'Sektor yang berfokus pada peningkatan kualitas pendidikan.'
            ],
            [
                'name' => 'Kebersihan',
                'image' => 'kebersihan.jpg',
                'description' => 'Sektor yang berfokus pada peningkatan kualitas pendidikan.'
            ],
        ];

        foreach ($sektors as $sektor) {
            Sektor::create($sektor);
        }
    }
}
