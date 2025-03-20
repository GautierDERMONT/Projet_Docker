<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\concours;

class ConcoursTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function la_liste_des_concours_est_affichée()
    {
        // Génère 3 concours pour le test
        concours::factory()->count(3)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('listeConcours');
    }
}
