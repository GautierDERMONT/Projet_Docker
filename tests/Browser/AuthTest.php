<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;

class AuthTest extends DuskTestCase
{
    public function testUtilisateur_peut_se_connecter_et_se_deconnecter()
    {
        $this->browse(function (Browser $browser) {
            // Test de connexion jury
            $browser->visit('/login')
                    ->type('login', 'jury')
                    ->type('password', 'password')
                    ->press('Se connecter')
                    ->assertPathIs('/');

            // Test déconnexion
            $browser->visit('/logout')
                    ->assertPathIs('/');

            // Test de connexion entrée
            $browser->visit('/login')
                    ->type('login', 'entree')
                    ->type('password', 'password')
                    ->press('Se connecter')
                    ->assertPathIs('/');
        });
    }
}
