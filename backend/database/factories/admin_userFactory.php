<?php

namespace Database\Factories;


use App\Models\admin_user;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class admin_userFactory extends Factory
{

    protected $model = admin_user::class;


    public function definition()
    {
        return [
            'user_id' => User::factory(),
        ];
    }
}
