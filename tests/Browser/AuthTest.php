<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;

class AuthTest extends DuskTestCase
{
    public function testUtilisateur_peut_se_connecter()
    {
        $this->browse(function (Browser $browser) {
            
            $browser->visit('/login')
                    ->type('login', 'jury')
                    ->type('password', 'password')
                    ->press('Se connecter')
                    ->assertPathIs('/');

            
        });
    }
}
