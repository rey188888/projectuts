<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kaprodi;
use App\Models\User;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Hash;

class KaprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure ProgramStudi record exists (optional if already created in another seeder)
        ProgramStudi::firstOrCreate(
            ['id_prodi' => 1],
            ['nama_prodi' => 'Teknik Informatika']
        );

        // Create User record first (since Kaprodi depends on it)
        User::create([
            'id_user' => 4001,
            'password' => Hash::make('123456'),
            'role' => 'kaprodi',
        ]);

        // Now create Kaprodi record (after User is created)
        Kaprodi::create([
            'id_kaprodi' => '001', // Use string since id_kaprodi is VARCHAR
            'nama' => 'Robby',
            'email' => 'robby@gmail.com',
            'id_prodi' => 1,
            'id_user' => 4001,
        ]);
    }
}