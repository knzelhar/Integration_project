<?php

namespace Database\Seeders;

use App\Models\parent_user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class parent_userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        parent_user::factory()->count(10)->create();
    }
}
