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

        // Laporan 1
        $laporan1 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 1',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 1.',
            'anggaran_realisasi' => 5000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitra->id,
            'sektor_id' => $sektor->id,
            'proyek_id' => $project->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_1_1.jpg',
            'laporan_id' => $laporan1->id,
        ]);

        // Laporan 2
        $laporan2 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 2',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 2.',
            'anggaran_realisasi' => 6000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitra->id,
            'sektor_id' => $sektor->id,
            'proyek_id' => $project->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_2_1.jpg',
            'laporan_id' => $laporan2->id,
        ]);

        // Laporan 3
        $laporan3 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 3',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 3.',
            'anggaran_realisasi' => 7000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitra->id,
            'sektor_id' => $sektor->id,
            'proyek_id' => $project->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_3_1.jpg',
            'laporan_id' => $laporan3->id,
        ]);

        // Laporan 4
        $laporan4 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 4',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 4.',
            'anggaran_realisasi' => 8000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitra->id,
            'sektor_id' => $sektor->id,
            'proyek_id' => $project->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_4_1.jpg',
            'laporan_id' => $laporan4->id,
        ]);

        // Laporan 5
        $laporan5 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 5',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 5.',
            'anggaran_realisasi' => 9000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitra->id,
            'sektor_id' => $sektor->id,
            'proyek_id' => $project->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_5_1.jpg',
            'laporan_id' => $laporan5->id,
        ]);

        // Laporan 6
        $laporan6 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 6',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 6.',
            'anggaran_realisasi' => 10000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitra->id,
            'sektor_id' => $sektor->id,
            'proyek_id' => $project->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_6_1.jpg',
            'laporan_id' => $laporan6->id,
        ]);

        // Laporan 7
        $laporan7 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 7',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 7.',
            'anggaran_realisasi' => 11000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitra->id,
            'sektor_id' => $sektor->id,
            'proyek_id' => $project->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_7_1.jpg',
            'laporan_id' => $laporan7->id,
        ]);

        // Laporan 8
        $laporan8 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 8',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 8.',
            'anggaran_realisasi' => 12000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitra->id,
            'sektor_id' => $sektor->id,
            'proyek_id' => $project->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_8_1.jpg',
            'laporan_id' => $laporan8->id,
        ]);

        // Laporan 9
        $laporan9 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 9',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 9.',
            'anggaran_realisasi' => 13000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitra->id,
            'sektor_id' => $sektor->id,
            'proyek_id' => $project->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_9_1.jpg',
            'laporan_id' => $laporan9->id,
        ]);

        // Laporan 10
        $laporan10 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 10',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 10.',
            'anggaran_realisasi' => 14000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitra->id,
            'sektor_id' => $sektor->id,
            'proyek_id' => $project->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_10_1.jpg',
            'laporan_id' => $laporan10->id,
        ]);
    }
}
