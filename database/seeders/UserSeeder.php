<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Ardhiya Febrian Radit',
            'email' => 'admin@test.mail',
            'password' => Hash::make('12345678'),
            'description' => 'Testing',
            'image' => 'smkn1ciomas.jpg',
            'role' => 'Admin',
            'first_time_user' => false,
            'email_verified_at' => now(),
        ]);
        User::create([
            'full_name' => 'Rahadian Fahri',
            'email' => 'rahadian@example.com',
            'password' => Hash::make('rahadian123'),
            'description' => 'Testing',
            'image' => 'rahadian.jpg',
            'first_time_user' => true,
            'email_verified_at' => now(),
        ]);
        User::create([
            'full_name' => 'Muhammad Noval',
            'email' => 'muhammadnoval@example.com',
            'password' => Hash::make('noval123'),
            'description' => 'Testing',
            'image' => 'noval.jpg',
            'first_time_user' => true,
            'email_verified_at' => now(),
        ]);
        User::create([
            'full_name' => 'Muhammad Rofi',
            'email' => 'rofinugraha@example.com',
            'password' => Hash::make('rofi123'),
            'description' => 'Testing',
            'image' => 'rofinugraha.jpg',
            'first_time_user' => true,
            'email_verified_at' => now(),
        ]);
        User::create([
            'full_name' => 'tubaguz kanz',
            'email' => 'tubaguz@example.com',
            'password' => Hash::make('tubaguz'),
            'description' => 'Testing',
            'image' => 'tubaguztebe.jpg',
            'first_time_user' => true,
            'email_verified_at' => now(),
        ]);
        User::create([
            'full_name' => 'Agis Septian',
            'email' => 'agisseptian@example.com',
            'password' => Hash::make('agis123'),
            'description' => 'Testing',
            'image' => 'agisseptian.jpg',
            'first_time_user' => true,
            'email_verified_at' => now(),
        ]);
        User::create([
            'full_name' => 'alifah samneta',
            'email' => 'alifahsamneta@example.com',
            'password' => Hash::make('alifah123'),
            'description' => 'Testing',
            'image' => 'alifah.jpg',
            'first_time_user' => true,
            'email_verified_at' => now(),
        ]);
        User::create([
            'full_name' => 'nanda dinda',
            'email' => 'nandadinda@example.com',
            'password' => Hash::make('nanda123'),
            'description' => 'Testing',
            'image' => 'nanda.jpg',
            'first_time_user' => true,
            'email_verified_at' => now(),
        ]);
        User::create([
            'full_name' => 'syifa aulia',
            'email' => 'syifaaulia@example.com',
            'password' => Hash::make('syifa123'),
            'description' => 'Testing',
            'image' => 'syifa.jpg',
            'first_time_user' => true,
            'email_verified_at' => now(),
        ]);
        User::create([
            'full_name' => 'sri ayu',
            'email' => 'ayusri@example.com',
            'password' => Hash::make('ayu123'),
            'description' => 'Testing',
            'image' => 'sriayu.jpg',
            'first_time_user' => true,
            'email_verified_at' => now(),
        ]);
    }
}
