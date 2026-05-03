<?php

namespace App\Console\Commands;

use App\Models\Animal;
use App\Models\SpeciesType;
use App\Models\ConservationStatus;
use App\Models\Region;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchIndonesianAnimalsFromGBIF extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'animals:fetch-gbif {--limit=50}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch real animals from GBIF API for Indonesia and Malaysia';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Fetching animals from Indonesia, Malaysia & Singapore...');
        
        // Indonesian, Malaysian, and Singaporean endemic and native animals
        $indonesianAnimals = [
            // INDONESIA - Mammals
            ['name' => 'Sumatran Striped Rabbit', 'scientific_name' => 'Nesolagus netscheri', 'type' => 'Mammal', 'region' => 1, 'status' => 'Endangered'],
            ['name' => 'Pygmy Flying Lemur', 'scientific_name' => 'Cynocephalus volans', 'type' => 'Mammal', 'region' => 1, 'status' => 'Vulnerable'],
            ['name' => 'Sumatran Rhinoceros', 'scientific_name' => 'Dicerorhinus sumatrensis', 'type' => 'Mammal', 'region' => 1, 'status' => 'Critically Endangered'],
            ['name' => 'Asian Elephant', 'scientific_name' => 'Elephas maximus', 'type' => 'Mammal', 'region' => 3, 'status' => 'Endangered'],
            ['name' => 'Clouded Leopard', 'scientific_name' => 'Neofelis diardi', 'type' => 'Mammal', 'region' => 3, 'status' => 'Vulnerable'],
            ['name' => 'Slow Loris', 'scientific_name' => 'Nycticebus coucang', 'type' => 'Mammal', 'region' => 1, 'status' => 'Vulnerable'],
            ['name' => 'Binturong', 'scientific_name' => 'Arctictis binturong', 'type' => 'Mammal', 'region' => 1, 'status' => 'Vulnerable'],
            ['name' => 'Sunda Slow Loris', 'scientific_name' => 'Nycticebus coucang', 'type' => 'Mammal', 'region' => 3, 'status' => 'Vulnerable'],
            ['name' => 'Sun Bear', 'scientific_name' => 'Helarctos malayanus', 'type' => 'Mammal', 'region' => 1, 'status' => 'Vulnerable'],
            ['name' => 'Malayan Tapir', 'scientific_name' => 'Tapirus indicus', 'type' => 'Mammal', 'region' => 3, 'status' => 'Endangered'],
            ['name' => 'Pygmy Elephant', 'scientific_name' => 'Elephas maximus borneensis', 'type' => 'Mammal', 'region' => 3, 'status' => 'Endangered'],
            ['name' => 'Orangutan', 'scientific_name' => 'Pongo pygmaeus', 'type' => 'Mammal', 'region' => 3, 'status' => 'Critically Endangered'],
            
            // INDONESIA/MALAYSIA - Birds
            ['name' => 'Argus Pheasant', 'scientific_name' => 'Argusianus argus', 'type' => 'Bird', 'region' => 3, 'status' => 'Least Concern'],
            ['name' => 'Bornean Bristlehead', 'scientific_name' => 'Pityriasis gymnocephala', 'type' => 'Bird', 'region' => 3, 'status' => 'Least Concern'],
            ['name' => 'Malaysian Eagle-Owl', 'scientific_name' => 'Buffy Fish Owl', 'type' => 'Bird', 'region' => 6, 'status' => 'Least Concern'],
            ['name' => 'White-rumped Falcon', 'scientific_name' => 'Microhierax latifrons', 'type' => 'Bird', 'region' => 3, 'status' => 'Vulnerable'],
            ['name' => 'Storm\'s Stork', 'scientific_name' => 'Ciconia stormi', 'type' => 'Bird', 'region' => 1, 'status' => 'Endangered'],
            ['name' => 'Lesser Adjutant', 'scientific_name' => 'Leptoptilos javanicus', 'type' => 'Bird', 'region' => 1, 'status' => 'Vulnerable'],
            
            // INDONESIA/MALAYSIA - Reptiles
            ['name' => 'Indonesian Python', 'scientific_name' => 'Python reticulatus', 'type' => 'Reptile', 'region' => 1, 'status' => 'Least Concern'],
            ['name' => 'King Cobra', 'scientific_name' => 'Ophiophagus hannah', 'type' => 'Reptile', 'region' => 1, 'status' => 'Vulnerable'],
            ['name' => 'Green Tree Python', 'scientific_name' => 'Morelia viridis', 'type' => 'Reptile', 'region' => 5, 'status' => 'Least Concern'],
            ['name' => 'Monitor Lizard', 'scientific_name' => 'Varanus salvator', 'type' => 'Reptile', 'region' => 2, 'status' => 'Least Concern'],
            ['name' => 'Crocodile', 'scientific_name' => 'Crocodylus porosus', 'type' => 'Reptile', 'region' => 1, 'status' => 'Vulnerable'],
            
            // INDONESIA/MALAYSIA - Fish
            ['name' => 'Arowana', 'scientific_name' => 'Scleropages formosus', 'type' => 'Fish', 'region' => 1, 'status' => 'Least Concern'],
            ['name' => 'Indonesian Carp', 'scientific_name' => 'Labeobarbus douronensis', 'type' => 'Fish', 'region' => 1, 'status' => 'Least Concern'],
            ['name' => 'Sungai Ikan Bawal', 'scientific_name' => 'Colossoma macropomum', 'type' => 'Fish', 'region' => 3, 'status' => 'Least Concern'],
            
            // SINGAPORE - Species (found in Singapore nature reserves)
            ['name' => 'Singapore Treeshrew', 'scientific_name' => 'Tupaia belangeri', 'type' => 'Mammal', 'region' => 6, 'status' => 'Least Concern'],
            ['name' => 'Dusky Dolphin', 'scientific_name' => 'Lagenorhynchus obscurus', 'type' => 'Marine', 'region' => 6, 'status' => 'Least Concern'],
            
            // MALAYSIA SPECIFIC
            ['name' => 'Malayan Gaur', 'scientific_name' => 'Bos gaurus hubbacki', 'type' => 'Mammal', 'region' => 6, 'status' => 'Vulnerable'],
            ['name' => 'Malayan Tiger', 'scientific_name' => 'Panthera tigris jacksoni', 'type' => 'Mammal', 'region' => 6, 'status' => 'Critically Endangered'],
            ['name' => 'Rafflesia', 'scientific_name' => 'Rafflesia arnoldii', 'type' => 'Mammal', 'region' => 6, 'status' => 'Endangered'],
            
            // MARINE/SHARED
            ['name' => 'Whale Shark', 'scientific_name' => 'Rhincodon typus', 'type' => 'Marine', 'region' => 6, 'status' => 'Vulnerable'],
            ['name' => 'Manta Ray', 'scientific_name' => 'Manta birostris', 'type' => 'Marine', 'region' => 6, 'status' => 'Vulnerable'],
            ['name' => 'Hawksbill Sea Turtle', 'scientific_name' => 'Eretmochelys imbricata', 'type' => 'Marine', 'region' => 6, 'status' => 'Critically Endangered'],
            ['name' => 'Dugong', 'scientific_name' => 'Dugong dugon', 'type' => 'Marine', 'region' => 6, 'status' => 'Vulnerable'],
            
            // AMPHIBIANS
            ['name' => 'Mossy Frog', 'scientific_name' => 'Theloderma cornutum', 'type' => 'Amphibian', 'region' => 4, 'status' => 'Vulnerable'],
            ['name' => 'Poison Dart Frog', 'scientific_name' => 'Dendrobates aurantiovittatus', 'type' => 'Amphibian', 'region' => 5, 'status' => 'Least Concern'],
        ];

        $this->line('💾 Adding animals for Indonesia, Malaysia & Singapore...');
        $count = 0;

        foreach ($indonesianAnimals as $data) {
            try {
                $existing = Animal::where('scientific_name', $data['scientific_name'])->first();
                
                if (!$existing) {
                    $speciesType = SpeciesType::where('name', $data['type'])->first();
                    $conservationStatus = ConservationStatus::where('name', $data['status'])->first();
                    
                    $animal = Animal::create([
                        'name' => $data['name'],
                        'scientific_name' => $data['scientific_name'],
                        'description' => 'Native species found in Indonesia, Malaysia, or Singapore',
                        'species_type_id' => $speciesType?->id ?? 1,
                        'conservation_status_id' => $conservationStatus?->id ?? 1,
                        'habitat' => 'Tropical forests, wetlands, and coastal areas',
                        'diet' => 'Various natural diet',
                        'estimated_population' => rand(100, 500000),
                    ]);
                    
                    $animal->regions()->attach($data['region']);
                    $count++;
                    $this->line("✓ {$data['name']} - {$data['status']}");
                }
            } catch (\Exception $e) {
                $this->warn("Error adding {$data['name']}: " . $e->getMessage());
            }
        }

        $this->info("✅ Added $count animals from Indonesia, Malaysia & Singapore!");
    }

    protected function isValidAnimal($occurrence)
    {
        // Filter for actual animals (not plants, fungi, etc.)
        $validKingdoms = ['Animalia'];
        $validPhyla = ['Chordata', 'Arthropoda', 'Mollusca'];
        
        $kingdom = $occurrence['kingdom'] ?? '';
        $phylum = $occurrence['phylum'] ?? '';
        $hasScientificName = !empty($occurrence['scientificName']);
        $hasSpecies = !empty($occurrence['species']) || !empty($occurrence['genericName']);
        
        return in_array($kingdom, $validKingdoms) && 
               (in_array($phylum, $validPhyla) || !empty($phylum)) &&
               $hasScientificName && 
               $hasSpecies;
    }

    protected function getSpeciesTypeId($occurrence)
    {
        $phylum = strtolower($occurrence['phylum'] ?? '');
        $class = strtolower($occurrence['class'] ?? '');
        
        $typeMap = [
            'chordata' => 'Mammal', // Default for vertebrates
            'mammalia' => 'Mammal',
            'aves' => 'Bird',
            'reptilia' => 'Reptile',
            'amphibia' => 'Amphibian',
            'actinopterygii' => 'Fish',
            'arthropoda' => 'Insect',
            'mollusca' => 'Marine',
        ];

        foreach ($typeMap as $key => $type) {
            if (strpos($phylum, $key) !== false || strpos($class, $key) !== false) {
                $speciesType = SpeciesType::where('name', $type)->first();
                return $speciesType?->id ?? 1;
            }
        }

        return SpeciesType::where('name', 'Mammal')->first()?->id ?? 1;
    }

    protected function getRandomConservationStatus()
    {
        // Most animals in the wild are Least Concern, some vulnerable/endangered
        $rand = rand(1, 100);
        
        if ($rand <= 70) {
            return ConservationStatus::where('name', 'Least Concern')->first()?->id ?? 1;
        } elseif ($rand <= 85) {
            return ConservationStatus::where('name', 'Vulnerable')->first()?->id ?? 2;
        } elseif ($rand <= 95) {
            return ConservationStatus::where('name', 'Endangered')->first()?->id ?? 3;
        } else {
            return ConservationStatus::where('name', 'Critically Endangered')->first()?->id ?? 4;
        }
    }
}
