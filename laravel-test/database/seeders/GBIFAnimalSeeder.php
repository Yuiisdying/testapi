<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\SpeciesType;
use App\Models\ConservationStatus;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class GBIFAnimalSeeder extends Seeder
{
    protected $seenScientificNames = [];
    protected $regionMap = [
        'Sumatra' => 1,
        'Java' => 2,
        'Borneo' => 3,
        'Sulawesi' => 4,
        'Papua' => 5,
    ];

    public function run(): void
    {
        $this->command->info('🌍 Fetching animals from GBIF...');

        try {
            // Disable foreign key checks to allow truncate
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            
            // Truncate animals table and related pivot tables
            Animal::truncate();
            DB::table('animal_region')->truncate();
            DB::table('animal_sea_zone')->truncate();
            
            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            
            $this->command->info('✓ Cleared existing animals and relationships');

            // Fetch from GBIF
            $animals = $this->fetchFromGBIF();
            $this->command->info("✓ Fetched " . count($animals) . " animals from GBIF");

            if (empty($animals)) {
                throw new \Exception('No animals fetched from GBIF');
            }

            // Insert fetched animals
            $inserted = 0;
            foreach ($animals as $animal) {
                try {
                    if ($this->createAnimal($animal)) {
                        $inserted++;
                    }
                } catch (\Exception $e) {
                    $this->command->error("Error creating animal: " . $e->getMessage());
                }
            }

            $this->command->info("✓ Successfully inserted $inserted animals");
        } catch (\Exception $e) {
            // Re-enable foreign key checks on error
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            
            $this->command->error("❌ GBIF fetch failed: " . $e->getMessage());
            $this->command->warn("Falling back to hardcoded animals...");
            
            // Truncate before fallback too (with FK checks disabled)
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            Animal::truncate();
            DB::table('animal_region')->truncate();
            DB::table('animal_sea_zone')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            
            // Fallback to hardcoded data
            $this->fallbackToHardcodedAnimals();
        }
    }

    protected function fetchFromGBIF()
    {
        $limit = 300;
        $animals = [];
        $offset = 0;
        $pageSize = 100;

        while (count($animals) < $limit) {
            $this->command->line("Fetching page " . (floor($offset / $pageSize) + 1) . "...");

            try {
                $response = Http::timeout(30)->get('https://api.gbif.org/v1/occurrence/search', [
                    'country' => 'ID',
                    'typeStatus' => 'specimen',
                    'limit' => $pageSize,
                    'offset' => $offset,
                    'hasCoordinate' => 'true',
                ]);

                if (!$response->successful()) {
                    $this->command->warn("GBIF returned status " . $response->status());
                    break;
                }

                $data = $response->json();
                $results = $data['results'] ?? [];

                if (empty($results)) {
                    break;
                }

                foreach ($results as $occurrence) {
                    if (count($animals) >= $limit) break;

                    if (empty($occurrence['scientificName'])) continue;

                    if (isset($this->seenScientificNames[$occurrence['scientificName']])) {
                        continue;
                    }

                    $this->seenScientificNames[$occurrence['scientificName']] = true;

                    $animal = [
                        'name' => $occurrence['species'] ?? $occurrence['scientificName'],
                        'scientific_name' => $occurrence['scientificName'],
                        'common_name' => $occurrence['vernacularName'] ?? '',
                        'description' => 'Species from GBIF database',
                        'kingdom' => $occurrence['kingdom'] ?? 'Animalia',
                        'class' => $occurrence['class'] ?? '',
                    ];

                    $animals[] = $animal;
                }

                $offset += $pageSize;
                sleep(1);

            } catch (\Exception $e) {
                $this->command->warn("Error fetching from GBIF: " . $e->getMessage());
                break;
            }
        }

        $this->command->info("✓ Fetched " . count($animals) . " unique animals");
        return array_slice($animals, 0, $limit);
    }

    protected function createAnimal($data)
    {
        // Map class to species type
        $speciesType = $this->mapClassToSpeciesType($data['class']);
        if (!$speciesType) {
            return false;
        }

        // Default conservation status
        $conservationStatus = ConservationStatus::where('name', 'Least Concern')->first();
        if (!$conservationStatus) {
            $conservationStatus = ConservationStatus::create([
                'name' => 'Least Concern',
                'description' => 'Not threatened',
                'icon' => '🟢'
            ]);
        }

        // Determine region based on coordinates or name
        $region = $this->determineRegion($data);

        // Create animal
        $animal = Animal::create([
            'name' => substr($data['name'], 0, 255),
            'scientific_name' => substr($data['scientific_name'] ?? '', 0, 255),
            'common_name' => substr($data['common_name'] ?? '', 0, 255),
            'description' => $data['description'] ?? 'Species from GBIF',
            'species_type_id' => $speciesType->id,
            'conservation_status_id' => $conservationStatus->id,
            'habitat' => $data['habitat'] ?? 'Indonesia',
            'diet' => '',
            'estimated_population' => null,
        ]);

        // Attach to region
        if ($region) {
            $animal->regions()->attach($region->id);
        }

        return true;
    }

    protected function mapClassToSpeciesType($class)
    {
        $classMap = [
            'Mammalia' => 'Mammal',
            'Aves' => 'Bird',
            'Reptilia' => 'Reptile',
            'Amphibia' => 'Amphibian',
            'Actinopterygii' => 'Fish',
            'Cephalopoda' => 'Marine',
            'Gastropoda' => 'Marine',
            'Bivalvia' => 'Marine',
        ];

        $typeCode = $classMap[$class] ?? null;
        if (!$typeCode) {
            return null;
        }

        return SpeciesType::where('name', $typeCode)->first();
    }

    protected function determineRegion($data)
    {
        // Try to match by coordinates
        if ($data['latitude'] && $data['longitude']) {
            $regions = Region::all();
            foreach ($regions as $region) {
                // Simple distance check
                if (abs($region->latitude - $data['latitude']) < 5 && 
                    abs($region->longitude - $data['longitude']) < 5) {
                    return $region;
                }
            }
        }

        // Default to first region (Sumatra)
        return Region::first();
    }

    protected function fallbackToHardcodedAnimals()
    {
        $this->command->info('Using hardcoded animal data as backup...');
        
        // This will seed the original 178 animals
        $this->call(AnimalSeeder::class);
    }
}
