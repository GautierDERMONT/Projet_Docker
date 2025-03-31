<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Collection;
use Laravel\Dusk\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\BeforeClass;

abstract class DuskTestCase extends BaseTestCase
{
    /**
     * Préparation avant l'exécution des tests Dusk.
     */
    #[BeforeClass]
    public static function prepare(): void
    {
        if (! static::runningInSail()) {
            // Démarre ChromeDriver sur le port 9515
            static::startChromeDriver(['--port=9515']);
        }
    }

    /**
     * Crée l'instance RemoteWebDriver.
     */
    protected function driver(): RemoteWebDriver
    {
        // Configuration des options Chrome
        $options = (new ChromeOptions)->addArguments(collect([
            '--window-size=1920,1080', 
            '--disable-search-engine-choice-screen',
            '--disable-smooth-scrolling',
            '--disable-gpu', 
            '--headless=new', 
            '--user-data-dir=/tmp/dusk-user-data-' . uniqid(), 
            '--no-sandbox', 
            '--disable-dev-shm-usage', 
            '--remote-debugging-port=9222', 
        ])->all());

        // Connexion à ChromeDriver
        return RemoteWebDriver::create(
            $_ENV['DUSK_DRIVER_URL'] ?? env('DUSK_DRIVER_URL') ?? 'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }
}
