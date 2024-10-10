<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'full_name' => 'SMKN 1 CIOMAS',
            'email' => 'smkn1ciomas@example.com',
            'password' => Hash::make('smkn1ciomas'),
            'description' => 'Testing',
            'image' => 'smkn1ciomas.jpg',
            'first_time_user' => true,
            'email_verified_at' => now(),
        ]);
    }
}
