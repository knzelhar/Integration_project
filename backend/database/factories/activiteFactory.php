<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\admin_user;
use Database\Factories\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\activte>
 */
class activiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'titre' => fake()->name(),
            // 'description' => $this->faker->text(),
            // 'objectif' => $this->faker->sentence(),
            // 'descriptif' => $this->faker->text(),
            // 'age_min' => $this->faker->numberBetween(7, 12),
            // 'age_max' => $this->faker->numberBetween(7, 12),
            // 'eff_min' => $this->faker->numberBetween(15, 30),
            // 'eff_max' => $this->faker->numberBetween(15, 30),
            // 'prix' => $this->faker->randomFloat(2, 0, 1000),
            // 'admin_id' => admin_user::factory()->create()->id,
            // 'animateur_id' => User::factory()->create()->id,
            // 'type_id' => type_activite::factory()->create()->id,

        ];

    }
}
