<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create ProgramStudi (Prodi) records first
        // ProgramStudi::create([
        //     'id_prodi' => 1,
        //     'nama_prodi' => 'Teknik Informatika',
        // ]);

        // ProgramStudi::create([
        //     'id_prodi' => 2,
        //     'nama_prodi' => 'Sistem Informasi',
        // ]);

        // ProgramStudi::create([
        //     'id_prodi' => 3,
        //     'nama_prodi' => 'S2 Ilmu Komputer',
        // ]);

        // Create User record first (since Mahasiswa depends on it)
        User::create([
            'id_user' => 1001,
            'password' => Hash::make('123456'),
            'role' => 'student',
        ]);

        // Now create Mahasiswa record (after User and Prodi are created)
        Mahasiswa::create([
            'nrp' => '2372013',
            'nama' => 'Rey',
            'email' => 'rey@gmail.com',
            'status_mhs' => 1, // No quotes needed since status_mhs is an integer
            'id_prodi' => 1,
            'tanggal_kelulusan' => null,
            'id_user' => 1001,
        ]);
    }
}