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

    public function definition()
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'role' => $this->faker->randomElement([0, 1, 2]),
            'password' => bcrypt('password'),
        ];
    }

    // public function withadmin()
    // {
    //     return $this->state(function (array $attributes) {
    //         return ['role' => 0]; // Assure que le rôle est 'admin'
    //     })
    //     ->has(
    //         admin_user::factory()
    //             ->count(3)
    //             ->state(function (array $attributes, User $user) {
    //                 return ['user_id' => $user->id];
    //             }),
    //             'admin_users' // Correspond au nom de la méthode dans le modèle User
    //         );
    // }

    public function withadmin()
    {
        return $this->state(function (array $attributes) {
            return ['role' => 0];
        })
        ->afterCreating(function (User $user) {
            admin_user::factory()->create(['user_id' => $user->id]);
        });
    }

    public function withanimateur()
    {
        return $this->state(function (array $attributes) {
            return ['role' => 1];
        })
        ->afterCreating(function (User $user) {
            animateur_user::factory()->create(['user_id' => $user->id]);
        });
    }

    public function withparent()
    {
        return $this->state(function (array $attributes) {
            return ['role' => 2];
        })
        ->afterCreating(function (User $user) {
            parent_user::factory()->create(['user_id' => $user->id]);
        });
    }
}