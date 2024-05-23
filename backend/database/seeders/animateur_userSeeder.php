<?php

namespace Database\Seeders;

use App\Models\animateur_user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class animateur_userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        animateur_user::factory()->count(10)->create();
    }
}
