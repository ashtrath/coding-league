<?php

namespace Database\Seeders;

use App\Enums\KegiatanStatus;
use App\Models\Kegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kegiatan::create([
            'title' => 'Kegiatan Sosial A',
            'content' => 'Konten kegiatan sosial A.',
            'description' => 'Deskripsi kegiatan sosial A yang melibatkan komunitas.',
            'image' => 'kegiatan_sosial_a.jpg',
            'status' => KegiatanStatus::Terbit->value, 
        ]);
    }
}
