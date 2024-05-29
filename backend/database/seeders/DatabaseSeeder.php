<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\admin_user;
use App\Models\animateur_user;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
        ->count(1)
        ->state(new Sequence(
            ['role'=>1],
        ))
        ->create()
        ->each(function($user){
            animateur_user::create([
                'user_id'=>2,
            ]);
        });
        // animateur_user::factory()
        //->count(1);
        // $this->call(

        //         UserSeeder::class,
        //         admin_userSeeder::class,
        // );
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
