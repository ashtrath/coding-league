<?php

namespace Database\Seeders;

use App\Enums\MitraStatus;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('User Tidak Tersedia');
            return;
        }

        foreach ($users as $user) {
            User::create([
                'full_name' => 'Aldo Siregar',
                'email' => 'aldogantengjelek@pm.me',
                'password' => Hash::make('AldoSecurePass!101'),
                'description' => 'Description for Aldo Siregar',
                'image' => 'aldo_siregar.jpg',
                'first_time_user' => true,
                'email_verified_at' => now(),
            ]);
    
            User::create([
                'full_name' => 'Budi Santoso',
                'email' => 'budisantoso@test.com',
                'password' => Hash::make('BudiSecurePass!202'),
                'description' => 'Description for Budi Santoso',
                'image' => 'budi_santoso.jpg',
                'first_time_user' => true,
                'email_verified_at' => now(),
            ]);
    
            User::create([
                'full_name' => 'Citra Dewi',
                'email' => 'citradewi9@gmail.com',
                'password' => Hash::make('CitraSecurePass!303'),
                'description' => 'Description for Citra Dewi',
                'image' => 'citra_dewi.jpg',
                'first_time_user' => true,
                'email_verified_at' => now(),
            ]);
    
            User::create([
                'full_name' => 'Dika Prasetya',
                'email' => 'dikaprasetya@mail.com',
                'password' => Hash::make('DikaSecurePass!404'),
                'description' => 'Description for Dika Prasetya',
                'image' => 'dika_prasetya.jpg',
                'first_time_user' => true,
                'email_verified_at' => now(),
            ]);
    
            User::create([
                'full_name' => 'Eka Sari',
                'email' => 'ekasari921@gg.com',
                'password' => Hash::make('EkaSecurePass!505'),
                'description' => 'Description for Eka Sari',
                'image' => 'eka_sari.jpg',
                'first_time_user' => true,
                'email_verified_at' => now(),
            ]);
    
            User::create([
                'full_name' => 'Fajar Nugraha',
                'email' => 'fajarnugraha158@proton.com',
                'password' => Hash::make('FajarSecurePass!606'),
                'description' => 'Description for Fajar Nugraha',
                'image' => 'fajar_nugraha.jpg',
                'first_time_user' => true,
                'email_verified_at' => now(),
            ]);
    
            User::create([
                'full_name' => 'Gina Lestari',
                'email' => 'ginalestari707@pm.com',
                'password' => Hash::make('GinaSecurePass!707'),
                'description' => 'Description for Gina Lestari',
                'image' => 'gina_lestari.jpg',
                'first_time_user' => true,
                'email_verified_at' => now(),
            ]);
    
            User::create([
                'full_name' => 'Hendra Kurniawan',
                'email' => 'hendrakurniawan@mailto.com',
                'password' => Hash::make('HendraSecurePass!808'),
                'description' => 'Description for Hendra Kurniawan',
                'image' => 'hendra_kurniawan.jpg',
                'first_time_user' => true,
                'email_verified_at' => now(),
            ]);
    
            User::create([
                'full_name' => 'Indah Permatasari',
                'email' => 'indahpermatasari@mailtooo.com',
                'password' => Hash::make('IndahSecurePass!909'),
                'description' => 'Description for Indah Permatasari',
                'image' => 'indah_permatasari.jpg',
                'first_time_user' => true,
                'email_verified_at' => now(),
            ]);
    
            User::create([
                'full_name' => 'Joko Widodo',
                'email' => 'joko.widodo@protons.com',
                'password' => Hash::make('JokoSecurePass!1010'),
                'description' => 'Description for Joko Widodo',
                'image' => 'joko_widodo.jpg',
                'first_time_user' => true, // Satu pengguna dengan first_time_user false
                'email_verified_at' => now(),
            ]);
        }
    }
}
