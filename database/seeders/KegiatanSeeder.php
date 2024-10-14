<?php

namespace Database\Seeders;

use App\Enums\KegiatanStatus;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        Kegiatan::create([
            'title' => 'Kegiatan Berbagi Sembako',
            'content' => 'Konten kegiatan berbagi sembako.',
            'description' => 'Deskripsi kegiatan berbagi sembako kepada masyarakat yang membutuhkan.',
            'image' => 'berbagi_sembako.jpg',
            'status' => KegiatanStatus::Terbit->value,
        ]);

        Kegiatan::create([
            'title' => 'Pelatihan Keterampilan Muda',
            'content' => 'Konten pelatihan keterampilan untuk anak muda.',
            'description' => 'Deskripsi kegiatan pelatihan keterampilan bagi pemuda untuk meningkatkan kemampuan.',
            'image' => 'pelatihan_keterampilan.jpg',
            'status' => KegiatanStatus::Terbit->value,
        ]);

        Kegiatan::create([
            'title' => 'Aksi Lingkungan Bersih',
            'content' => 'Konten aksi bersih-bersih lingkungan.',
            'description' => 'Deskripsi kegiatan untuk menjaga kebersihan lingkungan dengan aksi bersih-bersih.',
            'image' => 'aksi_lingkungan.jpg',
            'status' => KegiatanStatus::Terbit->value,
        ]);

        Kegiatan::create([
            'title' => 'Festival Seni Budaya',
            'content' => 'Konten festival seni budaya lokal.',
            'description' => 'Deskripsi festival yang menampilkan seni dan budaya daerah.',
            'image' => 'festival_seni_budaya.jpg',
            'status' => KegiatanStatus::Terbit->value,
        ]);

        Kegiatan::create([
            'title' => 'Pendidikan Anak Usia Dini',
            'content' => 'Konten pendidikan untuk anak usia dini.',
            'description' => 'Deskripsi kegiatan yang fokus pada pendidikan anak usia dini di komunitas.',
            'image' => 'pendidikan_usia_dini.jpg',
            'status' => KegiatanStatus::Terbit->value,
        ]);

        Kegiatan::create([
            'title' => 'Lomba Olahraga Tradisional',
            'content' => 'Konten lomba olahraga tradisional.',
            'description' => 'Deskripsi kegiatan lomba yang mengangkat olahraga tradisional.',
            'image' => 'lomba_olahraga.jpg',
            'status' => KegiatanStatus::Terbit->value,
        ]);

        Kegiatan::create([
            'title' => 'Kunjungan ke Panti Asuhan',
            'content' => 'Konten kunjungan ke panti asuhan.',
            'description' => 'Deskripsi kegiatan yang dilakukan di panti asuhan untuk berbagi kebahagiaan.',
            'image' => 'kunjungan_panti_asuhan.jpg',
            'status' => KegiatanStatus::Terbit->value,
        ]);

        Kegiatan::create([
            'title' => 'Bakti Sosial ke Desa Tertinggal',
            'content' => 'Konten bakti sosial ke desa tertinggal.',
            'description' => 'Deskripsi kegiatan bakti sosial untuk membantu desa yang kurang berkembang.',
            'image' => 'bakti_sosial.jpg',
            'status' => KegiatanStatus::Terbit->value,
        ]);

        Kegiatan::create([
            'title' => 'Pemberdayaan Perempuan',
            'content' => 'Konten pemberdayaan perempuan dalam komunitas.',
            'description' => 'Deskripsi kegiatan untuk memberdayakan perempuan melalui pelatihan.',
            'image' => 'pemberdayaan_perempuan.jpg',
            'status' => KegiatanStatus::Terbit->value,
        ]);

        Kegiatan::create([
            'title' => 'Seminar Kesehatan Mental',
            'content' => 'Konten seminar tentang kesehatan mental.',
            'description' => 'Deskripsi kegiatan seminar untuk meningkatkan kesadaran tentang kesehatan mental.',
            'image' => 'seminar_kesehatan_mental.jpg',
            'status' => KegiatanStatus::Terbit->value,
        ]);
    }
}
