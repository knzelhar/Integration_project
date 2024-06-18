<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\type_activite;
use App\Models\activite;
use App\Models\horaire;
use Database\Factories\ActiviteFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(1)->withadmin()->create();

        User::factory()->count(1)->withanimateur()->create();

        User::factory()->count(1)->withparent()->create();

        // Horaire::factory()->count(3)->create();

        Activite::factory()->count(3)
            ->withHoraires(3)
            ->create();

    }
}
