<?php

namespace Database\Seeders;

use App\Models\SpeciesType;
use Illuminate\Database\Seeder;

class SpeciesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Mammal', 'description' => 'Warm-blooded vertebrates with fur or hair', 'icon' => '🐘'],
            ['name' => 'Bird', 'description' => 'Feathered flying or flightless animals', 'icon' => '🦅'],
            ['name' => 'Reptile', 'description' => 'Cold-blooded scaled animals', 'icon' => '🐍'],
            ['name' => 'Amphibian', 'description' => 'Animals that live in water and land', 'icon' => '🐸'],
            ['name' => 'Fish', 'description' => 'Aquatic vertebrates with gills and fins', 'icon' => '🐠'],
            ['name' => 'Marine', 'description' => 'Sea-dwelling creatures', 'icon' => '🐚'],
            ['name' => 'Insect', 'description' => 'Small invertebrates with six legs', 'icon' => '🦋'],
        ];

        foreach ($types as $type) {
            SpeciesType::create($type);
        }
    }
}
