<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Staff;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
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

        // Create User record first (since Staff depends on it)
        User::create([
            'id_user' => 3001,
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        // Now create Staff record (after User is created)
        Staff::create([
            'id_staff' => '01', // Use string if id_staff is VARCHAR
            'nama' => 'Joko',
            'email' => 'joko@gmail.com',
            'id_prodi' => 1,
            'id_user' => 3001,
        ]);
    }
}