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

        Project::create([
            'title' => 'Proyek Infrastruktur A',
            'description' => 'Proyek untuk pembangunan jalan di kecamatan A.',
            'image' => 'proyek_infrastruktur_a.jpg',
            'lokasi_kecamatan' => 'Kecamatan A',
            'tanggal_awal' => '2024-01-01',
            'tanggal_akhir' => '2024-06-30',
            'status' => ProjectStatus::Terbit->value,
            'sektor_id' => $sektors->id,
        ]);
    }
}
