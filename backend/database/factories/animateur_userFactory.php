<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\animateur_user;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\animateur_user>
 */
class animateur_userFactory extends Factory
{
    protected $model = animateur_user::class;

    public function definition(): array
    {
        return [
            'domaine_comp' => $this->faker->word,
            'user_id' => 2,
        ];
    }
}
