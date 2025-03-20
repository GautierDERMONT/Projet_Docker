<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\concours;
use App\Models\epreuve;
use App\Models\couple;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->withRole('jury')->create(); 
        User::factory()->withRole('entrée de piste')->create();
        concours::factory(3)->create();
        epreuve::factory(7)->create();
        couple::factory(5)->create();
    }
}
