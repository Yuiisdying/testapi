<?php

namespace App\Console\Commands;

use App\Models\Animal;
use Illuminate\Console\Command;

class ExpandBiodiversity extends Command
{
    protected $signature = 'biodiversity:expand {--limit=100}';
    protected $description = 'Add more animals to reach 150+ species total';

    public function handle()
    {
        $limit = (int) $this->option('limit');
        $added = 0;

        $this->info("🌍 Expanding Indonesian & SE Asian biodiversity...\n");

        $additionalAnimals = [
            // More Primates
            ['name' => 'Siamangs', 'scientific_name' => 'Symphalangus syndactylus', 'type_id' => 1, 'status_id' => 2, 'description' => 'Gibbons with long arms for swinging through trees', 'habitat' => 'Tropical forests', 'diet' => 'Fruits, leaves', 'regions' => [1, 3]],
            ['name' => 'West Bornean Gibbon', 'scientific_name' => 'Hylobates albibarbis', 'type_id' => 1, 'status_id' => 2, 'description' => 'Small ape endemic to Borneo', 'habitat' => 'Rainforests', 'diet' => 'Fruits, insects', 'regions' => [3]],
            ['name' => 'Agile Gibbon', 'scientific_name' => 'Hylobates agilis', 'type_id' => 1, 'status_id' => 2, 'description' => 'Fast-moving gibbon in treetops', 'habitat' => 'Rainforests', 'diet' => 'Fruits, leaves', 'regions' => [3]],
            
            // Big Cats
            ['name' => 'Clouded Leopard', 'scientific_name' => 'Neofelis diardi', 'type_id' => 1, 'status_id' => 2, 'description' => 'Forest cat with distinctive cloud patterns', 'habitat' => 'Dense forests', 'diet' => 'Small mammals, birds', 'regions' => [1, 3, 4]],
            ['name' => 'Flat-headed Cat', 'scientific_name' => 'Prionailurus bengalensis', 'type_id' => 1, 'status_id' => 1, 'description' => 'Small wild cat near water', 'habitat' => 'Wetlands, forests', 'diet' => 'Fish, frogs, birds', 'regions' => [1, 2, 3]],
            
            // More Elephants & Rhinos
            ['name' => 'Sumatran Elephant', 'scientific_name' => 'Elephas maximus sumatranus', 'type_id' => 1, 'status_id' => 3, 'description' => 'Smallest elephant subspecies', 'habitat' => 'Tropical forests', 'diet' => 'Leaves, bark, fruits', 'regions' => [1]],
            
            // Birds - Raptors
            ['name' => 'Philippine Eagle', 'scientific_name' => 'Pithecophaga jefferyi', 'type_id' => 2, 'status_id' => 4, 'description' => 'One of world\'s rarest eagles', 'habitat' => 'Montane forests', 'diet' => 'Flying lemurs, flying snakes', 'regions' => [2]],
            ['name' => 'Java Hawk-Eagle', 'scientific_name' => 'Nisaetus bartelsi', 'type_id' => 2, 'status_id' => 3, 'description' => 'Rare endemic eagle of Java', 'habitat' => 'Montane forests', 'diet' => 'Small mammals, birds', 'regions' => [2]],
            ['name' => 'Sulawesi Hawk-Eagle', 'scientific_name' => 'Nisaetus lanceolatus', 'type_id' => 2, 'status_id' => 2, 'description' => 'Mountain forest eagle', 'habitat' => 'Montane forests', 'diet' => 'Small birds, squirrels', 'regions' => [4]],
            ['name' => 'Brahminy Kite', 'scientific_name' => 'Haliastur indus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Chestnut eagle near coasts', 'habitat' => 'Coastal areas, wetlands', 'diet' => 'Fish, crabs, birds', 'regions' => [1, 2, 3, 4, 5, 6]],
            
            // Birds - Owls
            ['name' => 'Spotted Wood-Owl', 'scientific_name' => 'Strix seloputo', 'type_id' => 2, 'status_id' => 1, 'description' => 'Nocturnal forest owl', 'habitat' => 'Dense forests', 'diet' => 'Rodents, insects', 'regions' => [1, 2, 3]],
            
            // Birds - Kingfishers
            ['name' => 'Blue-eared Kingfisher', 'scientific_name' => 'Alcedo meninting', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small blue kingfisher', 'habitat' => 'Rivers, streams', 'diet' => 'Small fish, insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Stork-billed Kingfisher', 'scientific_name' => 'Pelargopsis capensis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Large kingfisher with large bill', 'habitat' => 'Rivers, coasts', 'diet' => 'Fish, crustaceans', 'regions' => [1, 2]],
            
            // More Reptiles
            ['name' => 'King Cobra', 'scientific_name' => 'Ophiophagus hannah', 'type_id' => 3, 'status_id' => 2, 'description' => 'World\'s longest venomous snake', 'habitat' => 'Forests, wetlands', 'diet' => 'Other snakes, lizards', 'regions' => [1, 2, 3]],
            ['name' => 'Black Python', 'scientific_name' => 'Morelia atra', 'type_id' => 3, 'status_id' => 1, 'description' => 'All-black python from Papua', 'habitat' => 'Rainforests', 'diet' => 'Small mammals, birds', 'regions' => [5]],
            ['name' => 'Mangrove Pit Viper', 'scientific_name' => 'Cryptelytrops purpureomaculatus', 'type_id' => 3, 'status_id' => 1, 'description' => 'Venomous snake in mangroves', 'habitat' => 'Mangrove forests', 'diet' => 'Frogs, small mammals', 'regions' => [1, 2, 3, 4]],
            
            // Fish - Sharks
            ['name' => 'Tiger Shark', 'scientific_name' => 'Galeocerdo cuvier', 'type_id' => 4, 'status_id' => 2, 'description' => 'Large striped shark in tropical waters', 'habitat' => 'Coastal waters', 'diet' => 'Fish, marine mammals', 'regions' => [6]],
            ['name' => 'Bull Shark', 'scientific_name' => 'Carcharhinus leucas', 'type_id' => 4, 'status_id' => 1, 'description' => 'Aggressive shark in warm waters', 'habitat' => 'Coastal and freshwater', 'diet' => 'Fish, crustaceans', 'regions' => [1, 2, 5]],
            ['name' => 'Blacktip Reef Shark', 'scientific_name' => 'Carcharhinus melanopterus', 'type_id' => 4, 'status_id' => 1, 'description' => 'Common reef shark', 'habitat' => 'Shallow coral reefs', 'diet' => 'Fish, cephalopods', 'regions' => [1, 2, 3, 4, 5, 6]],
            
            // Marine Mammals
            ['name' => 'Finless Porpoise', 'scientific_name' => 'Neophocaena phocaenoides', 'type_id' => 5, 'status_id' => 2, 'description' => 'Small porpoise without dorsal fin', 'habitat' => 'Coastal waters', 'diet' => 'Small fish, squid', 'regions' => [2, 5, 6]],
            ['name' => 'Indian Ocean Humpback Dolphin', 'scientific_name' => 'Sousa plumbea', 'type_id' => 5, 'status_id' => 2, 'description' => 'Coastal dolphin with distinctive hump', 'habitat' => 'Coastal waters', 'diet' => 'Fish, squid', 'regions' => [1, 2]],
            ['name' => 'Spinner Dolphin', 'scientific_name' => 'Stenella longirostris', 'type_id' => 5, 'status_id' => 1, 'description' => 'Dolphin known for spinning leaps', 'habitat' => 'Open ocean', 'diet' => 'Fish, squid', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Bottlenose Dolphin', 'scientific_name' => 'Tursiops truncatus', 'type_id' => 5, 'status_id' => 1, 'description' => 'Intelligent dolphin in tropical seas', 'habitat' => 'Coastal and open ocean', 'diet' => 'Fish, squid', 'regions' => [1, 2, 3, 4, 5, 6]],
            
            // Fish - Reef Fish
            ['name' => 'Surgeonfish', 'scientific_name' => 'Acanthurus sohal', 'type_id' => 4, 'status_id' => 1, 'description' => 'Fish with spiny tail', 'habitat' => 'Coral reefs', 'diet' => 'Algae, small organisms', 'regions' => [1, 2, 3, 4, 5]],
            ['name' => 'Parrotfish', 'scientific_name' => 'Scaridae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Colorful reef fish', 'habitat' => 'Coral reefs', 'diet' => 'Coral, algae', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Butterfly Fish', 'scientific_name' => 'Chaetodontidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Colorful reef fish', 'habitat' => 'Coral reefs', 'diet' => 'Coral, plankton', 'regions' => [1, 2, 3, 4, 5, 6]],
            
            // Reptiles - Turtles
            ['name' => 'Olive Ridley Turtle', 'scientific_name' => 'Lepidochelys olivacea', 'type_id' => 3, 'status_id' => 3, 'description' => 'Small sea turtle', 'habitat' => 'Ocean and beaches', 'diet' => 'Fish, jellyfish, crustaceans', 'regions' => [6, 7, 8]],
            ['name' => 'Loggerhead Turtle', 'scientific_name' => 'Caretta caretta', 'type_id' => 3, 'status_id' => 3, 'description' => 'Large-headed sea turtle', 'habitat' => 'Ocean and beaches', 'diet' => 'Fish, mollusks, crustaceans', 'regions' => [1, 2, 5, 6, 7, 8]],
            
            // Mammals - Carnivores
            ['name' => 'Asian Palm Civet', 'scientific_name' => 'Paradoxurus hermaphroditus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Nocturnal tree mammal', 'habitat' => 'Forests, plantations', 'diet' => 'Fruits, insects, small animals', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Binturong', 'scientific_name' => 'Arctictis binturong', 'type_id' => 1, 'status_id' => 2, 'description' => 'Bearcat with distinctive tail', 'habitat' => 'Forests, plantations', 'diet' => 'Fruits, meat, insects', 'regions' => [1, 3, 4]],
            ['name' => 'Small-clawed Otter', 'scientific_name' => 'Aonyx cinereus', 'type_id' => 1, 'status_id' => 2, 'description' => 'Small otter with tiny claws', 'habitat' => 'Rivers, streams, wetlands', 'diet' => 'Fish, crustaceans', 'regions' => [1, 2, 3, 4]],
            
            // Mammals - Deer & Ungulates
            ['name' => 'Sambar Deer', 'scientific_name' => 'Rusa unicolor', 'type_id' => 1, 'status_id' => 1, 'description' => 'Large dark deer', 'habitat' => 'Forests, grasslands', 'diet' => 'Grasses, leaves, fruits', 'regions' => [1, 2, 3]],
            ['name' => 'Muntjac', 'scientific_name' => 'Muntiacus species', 'type_id' => 1, 'status_id' => 1, 'description' => 'Small barking deer', 'habitat' => 'Dense forests', 'diet' => 'Leaves, fruits, shoots', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Chevrotain', 'scientific_name' => 'Tragulus napu', 'type_id' => 1, 'status_id' => 1, 'description' => 'Tiny mouse deer', 'habitat' => 'Rainforests', 'diet' => 'Fruits, leaves, insects', 'regions' => [1, 2, 3]],
            
            // More Birds
            ['name' => 'Great Argus Pheasant', 'scientific_name' => 'Argusianus argus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Large pheasant with eyespots', 'habitat' => 'Rainforests', 'diet' => 'Seeds, insects, leaves', 'regions' => [1, 3]],
            ['name' => 'Bornean Peacock Pheasant', 'scientific_name' => 'Polyplectron schleiermacheri', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small peacock pheasant', 'habitat' => 'Montane forests', 'diet' => 'Seeds, insects', 'regions' => [3]],
            ['name' => 'Crested Serpent Eagle', 'scientific_name' => 'Spilornis cheela', 'type_id' => 2, 'status_id' => 1, 'description' => 'Snake-eating eagle', 'habitat' => 'Forests', 'diet' => 'Snakes, lizards', 'regions' => [1, 2, 3, 4, 5]],
            
            // More Amphibians
            ['name' => 'Bornean Flat-headed Frog', 'scientific_name' => 'Barbourula kalimantanensis', 'type_id' => 6, 'status_id' => 3, 'description' => 'Rare lungless frog', 'habitat' => 'Mountain streams', 'diet' => 'Small insects', 'regions' => [3]],
            ['name' => 'Painted Reed Frog', 'scientific_name' => 'Hyperolius marmoratus', 'type_id' => 6, 'status_id' => 1, 'description' => 'Colorful small frog', 'habitat' => 'Wetlands, reed beds', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4]],
            
            // Insects
            ['name' => 'Rajah Brooke Butterfly', 'scientific_name' => 'Trogonoptera brookiana', 'type_id' => 7, 'status_id' => 1, 'description' => 'Large iridescent butterfly', 'habitat' => 'Rainforests', 'diet' => 'Nectar', 'regions' => [1, 3]],
            ['name' => 'Atlas Moth', 'scientific_name' => 'Attacus atlas', 'type_id' => 7, 'status_id' => 1, 'description' => 'World\'s largest moth', 'habitat' => 'Tropical forests', 'diet' => 'Leaves', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Hercules Beetle', 'scientific_name' => 'Dynastes hercules', 'type_id' => 7, 'status_id' => 1, 'description' => 'Large horned beetle', 'habitat' => 'Rainforests', 'diet' => 'Rotting wood', 'regions' => [5]],
            
            // Small Mammals
            ['name' => 'Colugos', 'scientific_name' => 'Cynocephalus variegatus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Flying lemur with membrane', 'habitat' => 'Forests', 'diet' => 'Leaves, fruits', 'regions' => [1, 2, 3]],
            ['name' => 'Scaly Anteater', 'scientific_name' => 'Manis pentadactyla', 'type_id' => 1, 'status_id' => 2, 'description' => 'Pangolin with scales', 'habitat' => 'Forests, grasslands', 'diet' => 'Ants, termites', 'regions' => [1, 2]],
            ['name' => 'Slow Loris', 'scientific_name' => 'Nycticebus coucang', 'type_id' => 1, 'status_id' => 2, 'description' => 'Venomous nocturnal primate', 'habitat' => 'Rainforests', 'diet' => 'Insects, fruits, gums', 'regions' => [1, 2, 3]],
            
            // More Marine Species
            ['name' => 'Sea Cucumber', 'scientific_name' => 'Holothuroidea', 'type_id' => 4, 'status_id' => 1, 'description' => 'Sea floor scavenger', 'habitat' => 'Coral reefs, sea floor', 'diet' => 'Organic detritus', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Giant Clam', 'scientific_name' => 'Tridacna gigas', 'type_id' => 4, 'status_id' => 2, 'description' => 'World\'s largest clam', 'habitat' => 'Coral reefs', 'diet' => 'Plankton, zooxanthellae', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Mantis Shrimp', 'scientific_name' => 'Stomatopoda', 'type_id' => 4, 'status_id' => 1, 'description' => 'Powerful striped crustacean', 'habitat' => 'Coral reefs', 'diet' => 'Fish, crustaceans', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Grouper Fish', 'scientific_name' => 'Epinephelus species', 'type_id' => 4, 'status_id' => 1, 'description' => 'Large reef predator', 'habitat' => 'Coral reefs', 'diet' => 'Fish, crustaceans', 'regions' => [1, 2, 3, 4, 5, 6]],
            
            // Reptiles - More Snakes
            ['name' => 'Spitting Cobra', 'scientific_name' => 'Naja siamensis', 'type_id' => 3, 'status_id' => 1, 'description' => 'Cobra that spits venom', 'habitat' => 'Forests, grasslands', 'diet' => 'Snakes, small mammals', 'regions' => [1, 2, 3]],
            ['name' => 'Banded Krait', 'scientific_name' => 'Bungarus fasciatus', 'type_id' => 3, 'status_id' => 1, 'description' => 'Banded venomous snake', 'habitat' => 'Forests, rice fields', 'diet' => 'Snakes, eels', 'regions' => [1, 2, 3]],
            
            // Large Birds
            ['name' => 'Lesser Adjutant', 'scientific_name' => 'Leptoptilos javanicus', 'type_id' => 2, 'status_id' => 3, 'description' => 'Large stork in wetlands', 'habitat' => 'Wetlands, rivers', 'diet' => 'Fish, frogs, carrion', 'regions' => [1, 2, 3]],
            ['name' => 'Milky Stork', 'scientific_name' => 'Mycteria cinerea', 'type_id' => 2, 'status_id' => 3, 'description' => 'White stork in wetlands', 'habitat' => 'Wetlands, mangroves', 'diet' => 'Fish, crustaceans', 'regions' => [1, 2]],
            
            // Nocturnal
            ['name' => 'Tarsier', 'scientific_name' => 'Tarsius spectrum', 'type_id' => 1, 'status_id' => 1, 'description' => 'Tiny nocturnal primate', 'habitat' => 'Rainforests', 'diet' => 'Insects, small reptiles', 'regions' => [4]],
            ['name' => 'Cuscus', 'scientific_name' => 'Phalanger species', 'type_id' => 1, 'status_id' => 1, 'description' => 'Arboreal marsupial', 'habitat' => 'Rainforests', 'diet' => 'Leaves, fruits', 'regions' => [5]],
            
            // Water creatures
            ['name' => 'Saltwater Monitor', 'scientific_name' => 'Varanus salvator', 'type_id' => 3, 'status_id' => 1, 'description' => 'Large water monitor lizard', 'habitat' => 'Rivers, mangroves, coasts', 'diet' => 'Fish, crustaceans, carrion', 'regions' => [1, 2, 3, 4, 5]],
            ['name' => 'Gharial', 'scientific_name' => 'Gavialis gangeticus', 'type_id' => 3, 'status_id' => 3, 'description' => 'Fish-eating crocodilian', 'habitat' => 'Rivers', 'diet' => 'Fish', 'regions' => [1]],
        ];

        foreach ($additionalAnimals as $data) {
            if ($added >= $limit) break;

            $regions = $data['regions'];
            unset($data['regions']);

            // Rename type_id and status_id to proper field names
            if (isset($data['type_id'])) {
                $data['species_type_id'] = $data['type_id'];
                unset($data['type_id']);
            }
            if (isset($data['status_id'])) {
                $data['conservation_status_id'] = $data['status_id'];
                unset($data['status_id']);
            }

            // Check if animal exists
            if (!Animal::where('scientific_name', $data['scientific_name'])->exists()) {
                $animal = Animal::create($data);
                $animal->regions()->attach($regions);
                $this->line("✅ Added: {$data['name']}");
                $added++;
            } else {
                $this->line("⏭️  Skipping: {$data['name']} (already exists)");
            }
        }

        $total = Animal::count();
        $this->info("\n✨ Success!");
        $this->info("📊 Added $added new species");
        $this->info("🌍 Total animals in database: $total");
    }
}
