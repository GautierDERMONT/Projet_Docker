<?php

namespace Database\Seeders;

use App\Models\concours;
use App\Models\epreuve;
use App\Models\couple;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConcoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        concours::factory(3)->create();
        epreuve::factory(2)->create();
        couple::factory(5)->create();
    }
}
