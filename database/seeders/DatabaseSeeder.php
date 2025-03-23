<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            StudentSeeder::class,  // Creates ProgramStudi and User (id_user: 1001)
            AdminSeeder::class,    // Creates User (id_user: 2001)
            StaffSeeder::class,    // Creates User (id_user: 3001) and Staff
            KaprodiSeeder::class,  // Creates User (id_user: 4001) and Kaprodi
        ]);
    }
}