<?php

namespace Database\Seeders;

use App\Enums\MitraStatus;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'Mitra')->get();

        if ($users->isEmpty()) {
            $this->command->info('User Tidak Tersedia');
            return;
        }

        Mitra::create([
            'user_id' => $users[0]->id,
            'name_mitra' => 'Siregar',
            'name_company' => 'PT Aldo',
            'phone_number' => 1234563535423,
            'address' => 'address for Aldo Siregar',
            'status' => MitraStatus::Active->value,
        ]);

        Mitra::create([
            'user_id' => $users[1]->id,
            'name_mitra' => 'Santoso',
            'name_company' => 'PT Budi',
            'phone_number' => 1234563535223,
            'address' => 'address for Budi Santoso',
            'status' => MitraStatus::Active->value,
        ]);

        Mitra::create([
            'user_id' => $users[2]->id,
            'name_mitra' => 'Dewi Fashion',
            'name_company' => 'PT Citra',
            'phone_number' => 12345635354342,
            'address' => 'address for Citra Dewi',
            'status' => MitraStatus::Active->value,
        ]);

        Mitra::create([
            'user_id' => $users[3]->id,
            'name_mitra' => 'Prasetya',
            'name_company' => 'PT Dika',
            'phone_number' => 12345635353323,
            'address' => 'address for Dika Prasetya',
            'status' => MitraStatus::Active->value,
        ]);

        Mitra::create([
            'user_id' => $users[4]->id,
            'name_mitra' => 'EkaloSari',
            'name_company' => 'PT Eka',
            'phone_number' => 1124563535423,
            'address' => 'address for Eka Sari',
            'status' => MitraStatus::Active->value,
        ]);

        Mitra::create([
            'user_id' => $users[5]->id,
            'name_mitra' => 'Nugraha Citra',
            'name_company' => 'PT Fajar',
            'phone_number' => 12322263535423,
            'address' => 'address for Fajar Nugraha',
            'status' => MitraStatus::Active->value,
        ]);

        Mitra::create([
            'user_id' => $users[6]->id,
            'name_mitra' => 'Lestari Makmur',
            'name_company' => 'PT Gina',
            'phone_number' => 1234563735223,
            'address' => 'address for Gina Lestari',
            'status' => MitraStatus::Active->value,
        ]);

        Mitra::create([
            'user_id' => $users[7]->id,
            'name_mitra' => 'Kurniawan Datman',
            'name_company' => 'PT Hendra',
            'phone_number' => 123456353512,
            'address' => 'address for Hendra Kurniawan',
            'status' => MitraStatus::Active->value,
        ]);

        Mitra::create([
            'user_id' => $users[8]->id,
            'name_mitra' => 'Permatasari',
            'name_company' => 'PT Indah',
            'phone_number' => 1234585535423,
            'address' => 'address for Indah Permatasari',
            'status' => MitraStatus::Inactive->value,
        ]);
    }
}
