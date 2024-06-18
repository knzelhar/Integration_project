<?php
namespace Database\Factories;

use App\Models\type_activite;
use Illuminate\Database\Eloquent\Factories\Factory;

class type_activiteFactory extends Factory
{
    protected $model = type_activite::class;

    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
