<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Concours;

class ConcoursDbUnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_concours_peut_etre_cree_en_base()
    {
        // Arrange
        $concours = Concours::factory()->create([
            'numero' => 'DOC-12345',
            'intitule' => 'Test concours',
            'type' => 'Equifun',
            'date' => now(),
        ]);

        // Act & Assert
        $this->assertDatabaseHas('concours', [
            'numero' => 'DOC-12345',
            'intitule' => 'Test concours',
        ]);
    }
}
