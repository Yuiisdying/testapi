<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed biodiversity data
        $this->call([
            RegionSeeder::class,
            SpeciesTypeSeeder::class,
            ConservationStatusSeeder::class,
            AnimalSeeder::class,
            SeaZoneSeeder::class,
            MarineAnimalsSeeder::class,
            AnimalSeaZoneSeeder::class,
        ]);
    }
}
