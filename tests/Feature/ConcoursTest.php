<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\concours;
use App\Models\epreuve;
use App\Models\couple;
use App\Models\historiqueModif;

class ConcoursTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    /*
    public function la_page_d_accueil_affiche_les_concours()
    {
        concours::factory()->count(2)->create();

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertViewHas('listeConcours');
    }*/

    /** @test */
    public function concours_sont_affiches()
    {
        /**
         * @var concours $concours
         */
        $concours=concours::factory()->create();

        $response = $this->get('/');
        $response->assertStatus(200);

        $this->assertNotEmpty($concours->intitule);
        $response->assertSeeText($concours->intitule);
    }

    /** @test */
    public function epreuves_du_concours_sont_affiches()
    {
        /**
         * @var concours $concours
         * @var epreuve $epreuve
         */
        $concours=concours::factory()->create();
        $epreuve=epreuve::factory()->create([
            'concours_id'=>$concours->id
        ]);
        $response = $this->get("/concours/couples/{$concours->id}/1");
        $response->assertStatus(200);

        $this->assertNotEmpty($epreuve->titre);
        $response->assertSeeText($epreuve->titre);
    }

    /** @test */
    public function couples_dune_epreuve_sont_affiches()
    {
        /**
         * @var concours $concours
         * @var epreuve $epreuve
         * @var couple $couple
         */
        $concours=concours::factory()->create();
        $epreuve=epreuve::factory()->create([
            'concours_id'=>$concours->id
        ]);
        $couple=couple::factory()->create([
            'epreuve_id'=>$epreuve->id
        ]);
        $response = $this->get("/concours/couples/{$concours->id}/1");
        $response->assertStatus(200);

        $this->assertNotEmpty($couple->cavalier);
        $response->assertSeeText($couple->cavalier);
    }
}
