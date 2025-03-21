<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'login' => $this->faker->unique()->userName(),
            'nom' => $this->faker->name(),
            'role' => 'user',
            'password' => bcrypt('password'), // Assurer que le mot de passe est hashé
        ];
    }

    // Méthode pour créer un utilisateur avec un rôle spécifique
    public function withRole(string $role)
    {
        return $this->state(function (array $attributes) use ($role) {
            return [
                'role' => $role,
            ];
        });
    }
}
