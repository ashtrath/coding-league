<?php

namespace Database\Seeders;

use App\Models\ImageLaporan;
use App\Models\Laporan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporans =  Laporan::all();

        if ($laporans->isEmpty()) {
            $this->command->info('Tidak Ada Laporan Yang Tersedia');
            return;
        }

        foreach ($laporans as $laporan) {
            ImageLaporan::create([
                'image' => 'laporan_' . $laporan->id . '_1.jpg',
                'laporan_id' => $laporan->id,
            ]);

            ImageLaporan::create([
                'image' => 'laporan_' . $laporan->id . '_2.jpg',
                'laporan_id' => $laporan->id,
            ]);
        }
    }
}
