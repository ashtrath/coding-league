<?php

namespace Database\Seeders;

use App\Enums\MitraStatus;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            Mitra::create([
                'user_id' => $user->id,
                'name_mitra' => fake()->name(),
                'name_company' => fake()->company(),
                'phone_number' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'status' => MitraStatus::Active->value,
            ]);
        }
    }
}
