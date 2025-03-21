<?php

namespace Tests;

use Laravel\Dusk\Browser;
use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

abstract class DuskTestCase extends BaseTestCase
{
    /**
     * Prépare les tests Dusk.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        if (!static::runningOnVapor()) {
            static::startChromeDriver();
        }
    }

    /**
     * Retourne le WebDriver configuré pour se connecter à Selenium.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        return RemoteWebDriver::create(
            'http://selenium:4444/wd/hub', // Adresse du conteneur Selenium
            DesiredCapabilities::chrome()
        );
    }

    /**
     * Détermine l’URL de base utilisée dans les tests.
     *
     * @return string
     */
    protected function baseUrl()
    {
        return 'http://laravel_app'; // Nom du conteneur de l'app Laravel
    }

    /**
     * Vérifie si l'on est sur Vapor (plateforme serverless de Laravel).
     *
     * @return bool
     */
    protected static function runningOnVapor()
    {
        return getenv('VAPOR') !== false;
    }
}
