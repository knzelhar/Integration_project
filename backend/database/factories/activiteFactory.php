<?php
namespace Database\Factories;

use App\Models\Activite;
use App\Models\Horaire;
use App\Models\animateur_user;
use App\Models\admin_user;
use App\Models\type_activite;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActiviteFactory extends Factory
{
    protected $model = Activite::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'objectif' => $this->faker->sentence,
            'image_pub' => $this->faker->imageUrl,
            'lien_youtube' => $this->faker->url,
            'descriptif' => $this->faker->text,
            'age_min' => $this->faker->numberBetween(3, 5),
            'age_max' => $this->faker->numberBetween(6, 12),
            'eff_min' => $this->faker->numberBetween(5, 10),
            'eff_max' => $this->faker->numberBetween(11, 20),
            'prix' => $this->faker->randomFloat(2, 10, 100),
            'animateur_id' => null,
            'admin_id' => 1,
            'type_id' => type_activite::factory(),
        ];
    }

    public function withHoraires($horairesCount = 3)
    {
        return $this->afterCreating(function (Activite $activite) use ($horairesCount) {
            $horaires = Horaire::factory()->count($horairesCount)->create();
            $activite->horaires()->attach($horaires->pluck('id'));
        });
    }
}
