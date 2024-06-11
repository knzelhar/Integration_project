<?php

namespace Database\Factories;

use App\Models\animateur_user;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class animateur_userFactory extends Factory
{
    protected $model = animateur_user::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Crée un utilisateur pour chaque animateur_user
            'domaine_comp' => $this->faker->word,
        ];
    }
}