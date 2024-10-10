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
                'name' => 'Infrastruktur',
                'image' => 'infrastruktur.jpg',
                'description' => 'Sektor yang fokus pada pembangunan infrastruktur.'
            ],
            [
                'name' => 'Teknologi',
                'image' => 'teknologi.jpg',
                'description' => 'Sektor yang berkaitan dengan pengembangan teknologi.'
            ],
            [
                'name' => 'Pendidikan',
                'image' => 'pendidikan.jpg',
                'description' => 'Sektor yang berfokus pada peningkatan kualitas pendidikan.'
            ],
        ];

        foreach ($sektors as $sektor) {
            Sektor::create($sektor);
        }
    }
}
