<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends DuskTestCase
{
    use RefreshDatabase;

    /**
     * Test si l'utilisateur peut se connecter avec des identifiants valides.
     *
     * @return void
     */
    public function testUserCanLogin()
    {
        $user = User::factory()->create([
            'login' => 'testuser',
            'password' => bcrypt('password123')
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('login', $user->login)
                    ->type('password', 'password123')
                    ->waitForText('Se connecter', 10) // Attendre que le texte du bouton soit visible
                    ->press('Se connecter')
                    ->pause(1000)  // Attendre un peu plus longtemps pour la redirection
                    ->assertPathIs('/')  // Vérifier qu'on a bien été redirigé vers la page d'accueil
                    ->assertAuthenticatedAs($user);  // Vérifier que l'utilisateur est authentifié
        });
    }

    /**
     * Test l'échec de la connexion avec des identifiants invalides.
     *
     * @return void
     */
    public function testUserCannotLoginWithInvalidCredentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('login', 'invaliduser')
                    ->type('password', 'wrongpassword')
                    ->waitForText('Se connecter', 10) // Attendre que le texte du bouton soit visible
                    ->press('Se connecter')
                    ->pause(500)  // Attendre un peu plus longtemps pour la redirection
                    ->assertSee('Ces identifiants ne correspondent pas à nos enregistrements.');  // Vérifier le message d'erreur
        });
    }
}
