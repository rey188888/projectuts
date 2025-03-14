<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prodi;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Prodi::create([
        //     'id_prodi' => 1,
        //     'nama_prodi' => 'Teknik Informatika',
        // ]);

        Prodi::create([
            'id_prodi' => 2,
            'nama_prodi' => 'Sistem Informasi',
        ]);

        Prodi::create([
            'id_prodi' => 3,
            'nama_prodi' => 'S2 Ilmu Komputer',
        ]);

        // Mahasiswa::create([
        //     'nrp' => '2372013',
        //     'nama' => 'Rey',
        //     'email' => 'rey@gmail.com',
        //     'id_prodi' => 1,
        //     'tanggal_kelulusan' => null,
        // ]);

        // User::create([
        //     'id_user' => 1001,
        //     'password' => Hash::make('123456'),
        //     'role' => 'student',
        //     'nrp' => 2372013,
        // ]);

        
    }
}
