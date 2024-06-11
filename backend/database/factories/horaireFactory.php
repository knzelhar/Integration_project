<?php
namespace Database\Factories;

use App\Models\Horaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class HoraireFactory extends Factory
{
    protected $model = Horaire::class;

    public function definition()
    {
        return [
            'jour_par_semaine' => $this->faker->dayOfWeek,
            'debut' => $this->faker->time,
            'fin' => $this->faker->time,
        ];
    }
}
