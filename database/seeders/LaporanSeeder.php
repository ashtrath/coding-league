<?php

namespace Database\Seeders;

use App\Enums\LaporanStatus;
use App\Models\ImageLaporan;
use App\Models\Laporan;
use App\Models\Mitra;
use App\Models\Project;
use App\Models\Sektor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mitra = Mitra::first();
        $sektor = Sektor::first();
        $project = Project::first();

        if (!$mitra || !$sektor || !$project) {
            $this->command->info('Tidak Ada Mitra, Sektor, Atau Project Yang Tersedia');
            return;
        }

        $laporan = Laporan::create([
            'title' => 'Laporan Proyek PPLG',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG.',
            'anggaran_realisasi' => '5000000.00',
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitra->id,
            'sektor_id' => $sektor->id,
            'project_id' => $project->id,
        ]);

        ImageLaporan::create([
            'image' => 'laporan_image_1.jpg',
            'laporan_id' => $laporan->id,
        ]);
    }
}
