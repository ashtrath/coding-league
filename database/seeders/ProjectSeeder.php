<?php

namespace Database\Seeders;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\Sektor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $sektors = Sektor::all();
        if ($sektors->isEmpty()) {
            $this->command->info('Tidak Ada Data Sektor Yang Tersedia');
            return;
        }

        $projects = [
            [
                'title' => 'Proyek Infrastruktur A',
                'description' => 'Proyek untuk pembangunan jalan di kecamatan A.',
                'image' => 'proyek_infrastruktur_a.jpg',
                'lokasi_kecamatan' => 'Kecamatan A',
            ],
            [
                'title' => 'Proyek Teknologi B',
                'description' => 'Pengembangan sistem informasi untuk pelayanan publik.',
                'image' => 'proyek_teknologi_b.jpg',
                'lokasi_kecamatan' => 'Kecamatan B',
            ],
            [
                'title' => 'Proyek Pendidikan C',
                'description' => 'Renovasi dan perluasan sekolah dasar di kecamatan C.',
                'image' => 'proyek_pendidikan_c.jpg',
                'lokasi_kecamatan' => 'Kecamatan C',
            ],
            [
                'title' => 'Proyek Pendidikan D',
                'description' => 'Renovasi dan perluasan sekolah dasar di kecamatan D.',
                'image' => 'proyek_pendidikan_c.jpg',
                'lokasi_kecamatan' => 'Kecamatan D',
            ],
            [
                'title' => 'Proyek Pendidikan E',
                'description' => 'Renovasi dan perluasan sekolah dasar di kecamatan E.',
                'image' => 'proyek_pendidikan_c.jpg',
                'lokasi_kecamatan' => 'Kecamatan E',
            ],
            [
                'title' => 'Proyek Pendidikan F',
                'description' => 'Renovasi dan perluasan sekolah dasar di kecamatan F.',
                'image' => 'proyek_pendidikan_c.jpg',
                'lokasi_kecamatan' => 'Kecamatan F',
            ],
            [
                'title' => 'Proyek Pendidikan G',
                'description' => 'Renovasi dan perluasan sekolah dasar di kecamatan G.',
                'image' => 'proyek_pendidikan_c.jpg',
                'lokasi_kecamatan' => 'Kecamatan G',
            ],
            [
                'title' => 'Proyek Pendidikan H',
                'description' => 'Renovasi dan perluasan sekolah dasar di kecamatan H.',
                'image' => 'proyek_pendidikan_c.jpg',
                'lokasi_kecamatan' => 'Kecamatan H',
            ],
            [
                'title' => 'Proyek Pendidikan I',
                'description' => 'Renovasi dan perluasan sekolah dasar di kecamatan I.',
                'image' => 'proyek_pendidikan_c.jpg',
                'lokasi_kecamatan' => 'Kecamatan I',
            ],
        ];

        foreach ($projects as $project) {
            Project::create(array_merge($project, [
                'tanggal_awal' => now(),
                'tanggal_akhir' => now()->addMonths(6),
                'status' => ProjectStatus::Terbit->value,
                'sektor_id' => $sektors->random()->id,
            ]));
        }
    }
}
