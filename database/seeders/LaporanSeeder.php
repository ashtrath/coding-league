<?php

namespace Database\Seeders;

use App\Enums\LaporanStatus;
use App\Models\ImageLaporan;
use App\Models\Laporan;
use App\Models\Mitra;
use App\Models\Project;
use App\Models\Sektor;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $mitras = Mitra::all();
        $sektors = Sektor::all();
        $projects = Project::all();

        if (!$mitras || !$sektors || !$projects) {
            $this->command->info('Tidak Ada Mitra, Sektor, Atau Project Yang Tersedia');
            return;
        }

        $laporan1 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 1',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 1.',
            'anggaran_realisasi' => 5000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitras[0]->id,
            'sektor_id' => $sektors[0]->id,
            'project_id' => $projects[0]->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_1_1.jpg',
            'laporan_id' => $laporan1->id,
        ]);

        $laporan2 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 2',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 2.',
            'anggaran_realisasi' => 6000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitras[1]->id,
            'sektor_id' => $sektors[1]->id,
            'project_id' => $projects[1]->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_2_1.jpg',
            'laporan_id' => $laporan2->id,
        ]);

        $laporan3 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 3',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 3.',
            'anggaran_realisasi' => 7000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitras[2]->id,
            'sektor_id' => $sektors[2]->id,
            'project_id' => $projects[2]->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_3_1.jpg',
            'laporan_id' => $laporan3->id,
        ]);

        $laporan4 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 4',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 4.',
            'anggaran_realisasi' => 8000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitras[3]->id,
            'sektor_id' => $sektors[3]->id,
            'project_id' => $projects[1]->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_4_1.jpg',
            'laporan_id' => $laporan4->id,
        ]);

        $laporan5 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 5',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 5.',
            'anggaran_realisasi' => 9000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitras[4]->id,
            'sektor_id' => $sektors[4]->id,
            'project_id' => $projects[2]->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_5_1.jpg',
            'laporan_id' => $laporan5->id,
        ]);

        $laporan6 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 6',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 6.',
            'anggaran_realisasi' => 10000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitras[5]->id,
            'sektor_id' => $sektors[5]->id,
            'project_id' => $projects[0]->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_6_1.jpg',
            'laporan_id' => $laporan6->id,
        ]);

        $laporan7 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 7',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 7.',
            'anggaran_realisasi' => 11000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitras[6]->id,
            'sektor_id' => $sektors[6]->id,
            'project_id' => $projects[2]->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_7_1.jpg',
            'laporan_id' => $laporan7->id,
        ]);

        $laporan8 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 8',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 8.',
            'anggaran_realisasi' => 12000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitras[7]->id,
            'sektor_id' => $sektors[7]->id,
            'project_id' => $projects[0]->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_8_1.jpg',
            'laporan_id' => $laporan8->id,
        ]);

        $laporan9 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 9',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 9.',
            'anggaran_realisasi' => 13000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitras[8]->id,
            'sektor_id' => $sektors[8]->id,
            'project_id' => $projects[1]->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_9_1.jpg',
            'laporan_id' => $laporan9->id,
        ]);
        
        $laporan10 = Laporan::create([
            'title' => 'Laporan Proyek PPLG 10',
            'status' => LaporanStatus::Diterima->value,
            'description' => 'Deskripsi laporan untuk proyek PPLG 10.',
            'anggaran_realisasi' => 14000000.00,
            'tanggal_realisasi' => now(),
            'mitra_id' => $mitras[1]->id,
            'sektor_id' => $sektors[1]->id,
            'project_id' => $projects[0]->id,
        ]);
        ImageLaporan::create([
            'image' => 'laporan_image_10_1.jpg',
            'laporan_id' => $laporan10->id,
        ]);
    }
}
