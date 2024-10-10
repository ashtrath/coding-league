<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kegiatans = Kegiatan::all();

        if ($kegiatans->isEmpty()) {
            $this->command->info('Tidak Ada Data Kegiatan Yang Tersedia');
            return;
        }

        foreach ($kegiatans as $kegiatan) {
            Tag::create([
                'name' => 'Tag Sosial',
                'kegiatan_id' => $kegiatan->id,
            ]);
        }
    }
}
