<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\concours;

class ConcoursTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function la_page_d_accueil_affiche_les_concours()
    {
        concours::factory()->count(2)->create();

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertViewHas('listeConcours');
    }
}
