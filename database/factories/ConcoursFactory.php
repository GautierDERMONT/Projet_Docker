<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\concours>
 */
class ConcoursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'numero' => $this->faker->unique()->numerify('DOC-#####'), // Génère un numéro unique
            'intitule' => $this->faker->sentence(3), // Génère un titre aléatoire
            'type' => $this->faker->randomElement(['CSO', 'Equifun']), // Choix aléatoire
            'date' => $this->faker->date(), // Génère une date aléatoire
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
