<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $kegiatans = Kegiatan::all();

        if ($kegiatans->isEmpty()) {
            $this->command->info('Tidak Ada Data Kegiatan Yang Tersedia');
            return;
        }

        foreach ($kegiatans as $kegiatan) {
            Tag::create([
                'name' => 'Sosial',
                'kegiatan_id' => $kegiatan->id,
            ]);
            Tag::create([
                'name' => 'Lingkungan',
                'kegiatan_id' => $kegiatan->id,
            ]);
            Tag::create([
                'name' => 'Kerja Bakti',
                'kegiatan_id' => $kegiatan->id,
            ]);
            Tag::create([
                'name' => 'Penggalangan Dana',
                'kegiatan_id' => $kegiatan->id,
            ]);
            Tag::create([
                'name' => 'Sedekah',
                'kegiatan_id' => $kegiatan->id,
            ]);
            Tag::create([
                'name' => 'Peduli Sosial',
                'kegiatan_id' => $kegiatan->id,
            ]);
            Tag::create([
                'name' => 'Peduli Palestine',
                'kegiatan_id' => $kegiatan->id,
            ]);
            Tag::create([
                'name' => 'Kominfo',
                'kegiatan_id' => $kegiatan->id,
            ]);
            Tag::create([
                'name' => 'Pemerintah',
                'kegiatan_id' => $kegiatan->id,
            ]);
            Tag::create([
                'name' => 'Teknologi',
                'kegiatan_id' => $kegiatan->id,
            ]);
        }
    }
}
