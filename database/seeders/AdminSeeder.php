<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use firstOrCreate to avoid duplicate user
        User::firstOrCreate(
            ['id_user' => '2001'], // Check if this id_user exists
            [
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ]
        );
    }
}