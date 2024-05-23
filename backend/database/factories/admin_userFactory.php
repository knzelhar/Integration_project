<?php

namespace Database\Factories;

use Database\Factories\UserFactory;
use App\Models\User;
use App\Models\admin_user;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\admin_user>
 */
class admin_userFactory extends Factory
{

    protected $model = admin_user::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition(): array
    {
        return [
            // 'user_id' => UserFactory::new()->create()->id, // Associe l'admin_user à un utilisateur existant
            'user_id' => User::factory()->create()->id,
        ];
    }
}
