<?php

namespace Database\Factories;

use App\Models\couple;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\couple>
 */
class CoupleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = couple::class;
    public function definition(): array
    {
        return [
            'cavalier' => $this->faker->name(),
            'cheval' => $this->faker->word(),
            'coach' => $this->faker->name(),
            'ecurie' => $this->faker->word(),
            //'temps' => $this->faker->time('H:i:s'),
            //'penalite' => $this->faker->numberBetween(0, 20), // pénalité entre 0 et 20
            //'temps_total' => $this->faker->time('H:i:s'),
            'ordrePassage' => $this->faker->numberBetween(0, 500),
            //'classement' => $this->faker->numberBetween(1, 100), // classement entre 1 et 10
            'epreuve_id' => $this->faker->randomElement([1, 2]),
        ];
    }
}
