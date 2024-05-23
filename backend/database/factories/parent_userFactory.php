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

    public function definition(): array
    {
        return [
            'fonction' => $this->faker->word,
            'user_id' => User::factory()->create()->id,
        ];
    }
}
