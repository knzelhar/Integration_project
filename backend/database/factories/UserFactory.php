<?php

namespace Database\Factories;

use App\Models\admin_user;
use App\Models\animateur_user;
use App\Models\parent_user;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class UserFactory extends Factory
{

    protected $model = User::class;

    /**
     * Define the default state of the model.
     *
     * @return array
     */
    public function definition()
    {
        $role = $this->faker->randomElement([0, 1, 2]);
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'role' => $role,
            'password' => bcrypt('password'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            if ($user->role === 0) {
                // Admin User
                $user->admin_users()->create();
            } elseif ($user->role === 1) {
                // Animateur User
                $user->animateur_users()->create();
            } elseif ($user->role === 2) {
                // Parent User
                $user->parent_users()->create();
            }
        });
    }
}

