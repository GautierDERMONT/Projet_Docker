<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\concours;
use App\Models\epreuve;
use App\Models\couple;
use App\Models\historiqueModif;

class dbTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    /*public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/
    
    /** @test */
    public function un_concours_est_stocke_dans_la_bdd()
    {
        $concours=concours::factory()->create([
            'numero' => 'DOC-55555',
        ]);

        $this->assertDatabaseHas('concours', [
            'numero' => 'DOC-55555',
        ]);
    }

    /** @test */
    public function un_concours_est_efface_de_la_bdd()
    {
        $concours=concours::factory()->create();
        $concours->delete();

        $this->assertModelMissing($concours);
    }

    /** @test */
    public function une_epreuve_est_modifie_dans_la_bdd()
    {
        $concours=concours::factory()->create();
        $epreuve=epreuve::factory()->create([
            'titre' => 'Junior',
            'concours_id'=>$concours->id,
        ]);
        $epreuve->update([
            'titre' => 'Senior',
        ]);

        $this->assertDatabaseHas('epreuves', [
            'titre' => 'Senior',
        ]);
    }

    
}
