<?php

namespace Database\Factories;

use App\Models\epreuve;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\epreuve>
 */
class EpreuveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = epreuve::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->randomElement(["Senior","Benjamin","Poussin"]),
            'ordre' => $this->faker->randomDigitNotZero(),
            'statut' => 'à venir',
            'concours_id' => 1,
        ];
    }
}
