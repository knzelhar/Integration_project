<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\admin_user;

class admin_userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            // admin_user::Factory(2)->create(); // Génère 2 administrateurs
            admin_user::factory()->count(10)->create();
        }
    }
}
