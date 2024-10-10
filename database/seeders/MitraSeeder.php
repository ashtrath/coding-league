<?php

namespace Database\Seeders;

use App\Enums\MitraStatus;
use App\Models\Mitra;
use App\Models\User;
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
                'name_mitra' => 'Siregar',
                'name_company' => 'PT Aldo',
                'phone_number' => 1234563535423,
                'address' => 'address for Aldo Siregar',
                'status' => MitraStatus::Active->value,
            ]);
    
            Mitra::create([
                'user_id' => $user->id,
                'name_mitra' => 'Santoso',
                'name_company' => 'PT Budi',
                'phone_number' => 1234563535223,
                'address' => 'address for Budi Santoso',
                'status' => MitraStatus::Active->value,
            ]);
    
            Mitra::create([
                'user_id' => $user->id,
                'name_mitra' => 'Dewi Fashion',
                'name_company' => 'PT Citra',
                'phone_number' => 12345635354342,
                'address' => 'address for Citra Dewi',
                'status' => MitraStatus::Active->value,
            ]);
    
            Mitra::create([
                'user_id' => $user->id,
                'name_mitra' => 'Prasetya',
                'name_company' => 'PT Dika',
                'phone_number' => 12345635353323,
                'address' => 'address for Dika Prasetya',
                'status' => MitraStatus::Active->value,
            ]);
    
            Mitra::create([
                'user_id' => $user->id,
                'name_mitra' => 'EkaloSari',
                'name_company' => 'PT Eka',
                'phone_number' => 1124563535423,
                'address' => 'address for Eka Sari',
                'status' => MitraStatus::Active->value,
            ]);
    
            Mitra::create([
                'user_id' => $user->id,
                'name_mitra' => 'Nugraha Citra',
                'name_company' => 'PT Fajar',
                'phone_number' => 12322263535423,
                'address' => 'address for Fajar Nugraha',
                'status' => MitraStatus::Active->value,
            ]);
    
            Mitra::create([
                'user_id' => $user->id,
                'name_mitra' => 'Lestari Makmur',
                'name_company' => 'PT Gina',
                'phone_number' => 1234563735223,
                'address' => 'address for Gina Lestari',
                'status' => MitraStatus::Active->value,
            ]);
    
            Mitra::create([
                'user_id' => $user->id,
                'name_mitra' => 'Kurniawan Datman',
                'name_company' => 'PT Hendra',
                'phone_number' => 123456353512,
                'address' => 'address for Hendra Kurniawan',
                'status' => MitraStatus::Active->value,
            ]);
    
            Mitra::create([
                'user_id' => $user->id,
                'name_mitra' => 'Permatasari',
                'name_company' => 'PT Indah',
                'phone_number' => 1234585535423,
                'address' => 'address for Indah Permatasari',
                'status' => MitraStatus::Inactive->value,
            ]);
    
            Mitra::create([
                'user_id' => $user->id,
                'name_mitra' => 'Widodo Garam',
                'name_company' => 'PDI',
                'phone_number' => 99234563535423,
                'address' => 'address for Joko Widodo',
                'status' => MitraStatus::Inactive->value,
            ]);
        }
    }
}
