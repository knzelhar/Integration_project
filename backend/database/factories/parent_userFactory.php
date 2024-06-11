<?php

namespace Database\Factories;

use App\Models\parent_user;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\parent_user>
 */
class parent_userFactory extends Factory
{
    protected $model = parent_user::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Crée un utilisateur pour chaque parent_user
            'fonction' => $this->faker->word,
            ];
    }
}