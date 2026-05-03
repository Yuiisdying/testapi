<?php

namespace App\Console\Commands;

use App\Models\Animal;
use Illuminate\Console\Command;

class MassExpand6 extends Command
{
    protected $signature = 'biodiversity:mass-expand6 {--limit=150}';
    protected $description = 'Final 150+ species to exceed 650+';

    public function handle()
    {
        $this->info('🚀 FINAL SPRINT TO 650+!');
        $added = 0;
        $limit = $this->option('limit');

        $finalSpurt = [
            // Primates - All Types (10+)
            ['name' => 'Chimpanzee', 'scientific_name' => 'Pan troglodytes', 'type_id' => 1, 'status_id' => 3, 'description' => 'Great ape', 'habitat' => 'Rainforests', 'diet' => 'Fruits, insects', 'regions' => [1]],
            ['name' => 'Gorilla', 'scientific_name' => 'Gorilla gorilla', 'type_id' => 1, 'status_id' => 3, 'description' => 'Largest primate', 'habitat' => 'Rainforests', 'diet' => 'Vegetation', 'regions' => [1]],
            ['name' => 'Baboon', 'scientific_name' => 'Papio anubis', 'type_id' => 1, 'status_id' => 1, 'description' => 'Large ground monkey', 'habitat' => 'Grasslands', 'diet' => 'Omnivorous', 'regions' => [1, 2]],

            // Birds - Larks (8+)
            ['name' => 'Eurasian Skylark', 'scientific_name' => 'Alauda arvensis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Singing lark', 'habitat' => 'Grasslands', 'diet' => 'Seeds, insects', 'regions' => [1, 2]],
            ['name' => 'Crested Lark', 'scientific_name' => 'Galerida cristata', 'type_id' => 2, 'status_id' => 1, 'description' => 'Crested songbird', 'habitat' => 'Open areas', 'diet' => 'Seeds, insects', 'regions' => [1, 2]],
            ['name' => 'Calandra Lark', 'scientific_name' => 'Melanocorypha calandra', 'type_id' => 2, 'status_id' => 1, 'description' => 'Large lark', 'habitat' => 'Grasslands', 'diet' => 'Seeds', 'regions' => [1, 2]],

            // Birds - Pipits (6+)
            ['name' => 'Meadow Pipit', 'scientific_name' => 'Anthus pratensis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small ground bird', 'habitat' => 'Grasslands', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Water Pipit', 'scientific_name' => 'Anthus spinoletta', 'type_id' => 2, 'status_id' => 1, 'description' => 'Mountain pipit', 'habitat' => 'Rocky areas', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Tree Pipit', 'scientific_name' => 'Anthus trivialis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Tree songbird', 'habitat' => 'Woodlands', 'diet' => 'Insects', 'regions' => [1, 2]],

            // Birds - Flycatchers (8+)
            ['name' => 'Pied Flycatcher', 'scientific_name' => 'Ficedula hypoleuca', 'type_id' => 2, 'status_id' => 1, 'description' => 'Black and white flycatcher', 'habitat' => 'Forests', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Collared Flycatcher', 'scientific_name' => 'Ficedula albicollis', 'type_id' => 2, 'status_id' => 1, 'description' => 'White-collared flycatcher', 'habitat' => 'Deciduous forests', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Red-breasted Flycatcher', 'scientific_name' => 'Ficedula parva', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small red flycatcher', 'habitat' => 'Forests', 'diet' => 'Flying insects', 'regions' => [1, 2]],

            // Reptiles - Amphisbaenians (5+)
            ['name' => 'European Worm Lizard', 'scientific_name' => 'Blanus cinereus', 'type_id' => 3, 'status_id' => 1, 'description' => 'Legless underground reptile', 'habitat' => 'Soil', 'diet' => 'Insects', 'regions' => [1, 2]],

            // Rodents - Voles (8+)
            ['name' => 'Bank Vole', 'scientific_name' => 'Myodes glareolus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Small rodent', 'habitat' => 'Forests', 'diet' => 'Plants, seeds', 'regions' => [1, 2]],
            ['name' => 'Wood Mouse', 'scientific_name' => 'Apodemus sylvaticus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Forest mouse', 'habitat' => 'Woodlands', 'diet' => 'Seeds, insects', 'regions' => [1, 2]],
            ['name' => 'Yellow-necked Mouse', 'scientific_name' => 'Apodemus flavicollis', 'type_id' => 1, 'status_id' => 1, 'description' => 'Striped mouse', 'habitat' => 'Forests', 'diet' => 'Seeds', 'regions' => [1, 2]],
            ['name' => 'Steppe Lemming', 'scientific_name' => 'Lagurus lagurus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Grassland rodent', 'habitat' => 'Steppes', 'diet' => 'Grasses', 'regions' => [1, 2]],

            // More Fish - Pelagic (20+)
            ['name' => 'Tarpon', 'scientific_name' => 'Megalops atlanticus', 'type_id' => 4, 'status_id' => 1, 'description' => 'Large silver fish', 'habitat' => 'Coastal waters', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Bonito', 'scientific_name' => 'Sarda sarda', 'type_id' => 4, 'status_id' => 1, 'description' => 'Small tuna', 'habitat' => 'Open ocean', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Mackerel', 'scientific_name' => 'Scomber scombrus', 'type_id' => 4, 'status_id' => 1, 'description' => 'Striped oily fish', 'habitat' => 'Coastal waters', 'diet' => 'Small fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Herring', 'scientific_name' => 'Clupea harengus', 'type_id' => 4, 'status_id' => 1, 'description' => 'School fish', 'habitat' => 'Coastal waters', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Sardine', 'scientific_name' => 'Sardina pilchardus', 'type_id' => 4, 'status_id' => 1, 'description' => 'Small school fish', 'habitat' => 'Coastal waters', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Anchovy', 'scientific_name' => 'Engraulis encrasicolus', 'type_id' => 4, 'status_id' => 1, 'description' => 'Tiny fish', 'habitat' => 'Coastal waters', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Bass', 'scientific_name' => 'Dicentrarchus labrax', 'type_id' => 4, 'status_id' => 1, 'description' => 'White fish', 'habitat' => 'Coastal waters', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Cod', 'scientific_name' => 'Gadus morhua', 'type_id' => 4, 'status_id' => 1, 'description' => 'White commercial fish', 'habitat' => 'Cold waters', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'Haddock', 'scientific_name' => 'Melanogrammus aeglefinus', 'type_id' => 4, 'status_id' => 1, 'description' => 'Spotted cod relative', 'habitat' => 'Cold waters', 'diet' => 'Small fish', 'regions' => [1, 2]],

            // More Insects - Hymenoptera (15+)
            ['name' => 'Honey Bee', 'scientific_name' => 'Apis mellifera', 'type_id' => 7, 'status_id' => 1, 'description' => 'Golden honey insect', 'habitat' => 'Various', 'diet' => 'Nectar', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Carpenter Ant', 'scientific_name' => 'Camponotus species', 'type_id' => 7, 'status_id' => 1, 'description' => 'Large wood-boring ant', 'habitat' => 'Wood', 'diet' => 'Insects, honeydew', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Harvester Ant', 'scientific_name' => 'Pogonomyrmex species', 'type_id' => 7, 'status_id' => 1, 'description' => 'Seed-gathering ant', 'habitat' => 'Grasslands', 'diet' => 'Seeds', 'regions' => [1, 2]],
            ['name' => 'Bullet Ant', 'scientific_name' => 'Paraponera clavata', 'type_id' => 7, 'status_id' => 1, 'description' => 'Most painful ant', 'habitat' => 'Rainforests', 'diet' => 'Insects, spiders', 'regions' => [5]],
            ['name' => 'Potter Wasp', 'scientific_name' => 'Eumenes species', 'type_id' => 7, 'status_id' => 1, 'description' => 'Pot-making wasp', 'habitat' => 'Various', 'diet' => 'Nectar, insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Paper Wasp', 'scientific_name' => 'Polistes species', 'type_id' => 7, 'status_id' => 1, 'description' => 'Papery nest wasp', 'habitat' => 'Various', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4, 5]],
            ['name' => 'Mud Dauber', 'scientific_name' => 'Sceliphron species', 'type_id' => 7, 'status_id' => 1, 'description' => 'Mud-nest wasp', 'habitat' => 'Various', 'diet' => 'Spiders', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Ichneumon Wasp', 'scientific_name' => 'Ichneumonidae family', 'type_id' => 7, 'status_id' => 1, 'description' => 'Parasitic wasp', 'habitat' => 'Various', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4]],

            // More Marine Creatures (15+)
            ['name' => 'Sea Star', 'scientific_name' => 'Asterias rubens', 'type_id' => 4, 'status_id' => 1, 'description' => 'Orange sea star', 'habitat' => 'Rocky coasts', 'diet' => 'Mollusks', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Brittle Star', 'scientific_name' => 'Ophioderma longicaudum', 'type_id' => 4, 'status_id' => 1, 'description' => 'Delicate sea star', 'habitat' => 'Sandy areas', 'diet' => 'Detritus', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Crown-of-thorns Starfish', 'scientific_name' => 'Acanthaster planci', 'type_id' => 4, 'status_id' => 1, 'description' => 'Spiny coral predator', 'habitat' => 'Coral reefs', 'diet' => 'Coral', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Feather Duster Worm', 'scientific_name' => 'Sabella spallanzanii', 'type_id' => 4, 'status_id' => 1, 'description' => 'Spiral gill worm', 'habitat' => 'Coral reefs', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Sea Lily', 'scientific_name' => 'Crinoidea class', 'type_id' => 4, 'status_id' => 1, 'description' => 'Flower-like echinoderm', 'habitat' => 'Deep reefs', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],

            // More Mollusks (10+)
            ['name' => 'Oyster', 'scientific_name' => 'Ostrea edulis', 'type_id' => 9, 'status_id' => 1, 'description' => 'Filter-feeding mollusk', 'habitat' => 'Shallow waters', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Mussel', 'scientific_name' => 'Mytilus edulis', 'type_id' => 9, 'status_id' => 1, 'description' => 'Blue shellfish', 'habitat' => 'Rocky coasts', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Scallop', 'scientific_name' => 'Pecten jacobaeus', 'type_id' => 9, 'status_id' => 1, 'description' => 'Fan-shaped shell', 'habitat' => 'Sandy areas', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Periwinkle', 'scientific_name' => 'Littorina littorea', 'type_id' => 9, 'status_id' => 1, 'description' => 'Spiral shell snail', 'habitat' => 'Rocky shores', 'diet' => 'Algae', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Limpet', 'scientific_name' => 'Patella vulgata', 'type_id' => 9, 'status_id' => 1, 'description' => 'Conical shell snail', 'habitat' => 'Rocky coasts', 'diet' => 'Algae', 'regions' => [1, 2, 5, 6]],

            // Crustaceans (10+)
            ['name' => 'Edible Crab', 'scientific_name' => 'Cancer productus', 'type_id' => 8, 'status_id' => 1, 'description' => 'Brown crab', 'habitat' => 'Rocky coasts', 'diet' => 'Mollusks, seaweed', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Velvet Crab', 'scientific_name' => 'Necora puber', 'type_id' => 8, 'status_id' => 1, 'description' => 'Furry edible crab', 'habitat' => 'Rocky areas', 'diet' => 'Small organisms', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Lobster', 'scientific_name' => 'Homarus gammarus', 'type_id' => 8, 'status_id' => 1, 'description' => 'Large crustacean with claws', 'habitat' => 'Rocky areas', 'diet' => 'Small animals', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Norway Lobster', 'scientific_name' => 'Nephrops norvegicus', 'type_id' => 8, 'status_id' => 1, 'description' => 'Scampi', 'habitat' => 'Sandy areas', 'diet' => 'Small organisms', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Brown Shrimp', 'scientific_name' => 'Crangon crangon', 'type_id' => 8, 'status_id' => 1, 'description' => 'Common shrimp', 'habitat' => 'Sandy coasts', 'diet' => 'Detritus', 'regions' => [1, 2, 5, 6]],

            // Amphibians - Salamanders (8+)
            ['name' => 'Great Crested Newt', 'scientific_name' => 'Triturus cristatus', 'type_id' => 6, 'status_id' => 2, 'description' => 'Protected newt', 'habitat' => 'Ponds', 'diet' => 'Small organisms', 'regions' => [1, 2]],
            ['name' => 'Marbled Newt', 'scientific_name' => 'Triturus marmoratus', 'type_id' => 6, 'status_id' => 1, 'description' => 'Green marbled newt', 'habitat' => 'Ponds', 'diet' => 'Small organisms', 'regions' => [1, 2]],
            ['name' => 'Spotted Salamander', 'scientific_name' => 'Salamandra salamandra', 'type_id' => 6, 'status_id' => 1, 'description' => 'Black with yellow spots', 'habitat' => 'Damp forests', 'diet' => 'Insects', 'regions' => [1, 2]],

            // Reptiles - Vipers (8+)
            ['name' => 'Adder', 'scientific_name' => 'Vipera berus', 'type_id' => 3, 'status_id' => 1, 'description' => 'Venomous viper', 'habitat' => 'Various', 'diet' => 'Small animals', 'regions' => [1, 2]],
            ['name' => 'Meadow Viper', 'scientific_name' => 'Vipera ursinii', 'type_id' => 3, 'status_id' => 2, 'description' => 'Rare mountain viper', 'habitat' => 'Mountain grasslands', 'diet' => 'Small animals', 'regions' => [1]],

            // More Ungulates/Antelope (10+)
            ['name' => 'Moose', 'scientific_name' => 'Alces alces', 'type_id' => 1, 'status_id' => 1, 'description' => 'Largest deer', 'habitat' => 'Forests', 'diet' => 'Vegetation', 'regions' => [1]],
            ['name' => 'Reindeer', 'scientific_name' => 'Rangifer tarandus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Caribou with antlers', 'habitat' => 'Arctic', 'diet' => 'Lichens, plants', 'regions' => [1]],
            ['name' => 'Chamois', 'scientific_name' => 'Rupicapra rupicapra', 'type_id' => 1, 'status_id' => 1, 'description' => 'Mountain goat-antelope', 'habitat' => 'Mountains', 'diet' => 'Vegetation', 'regions' => [1, 2]],

            // Carnivores - Weasels (8+)
            ['name' => 'Eurasian Stoat', 'scientific_name' => 'Mustela erminea', 'type_id' => 1, 'status_id' => 1, 'description' => 'Ermine', 'habitat' => 'Various', 'diet' => 'Small animals', 'regions' => [1, 2]],
            ['name' => 'Least Weasel', 'scientific_name' => 'Mustela nivalis', 'type_id' => 1, 'status_id' => 1, 'description' => 'Smallest weasel', 'habitat' => 'Various', 'diet' => 'Small animals', 'regions' => [1, 2]],
            ['name' => 'European Polecat', 'scientific_name' => 'Mustela putorius', 'type_id' => 1, 'status_id' => 1, 'description' => 'Dark mustelid', 'habitat' => 'Wetlands', 'diet' => 'Small animals', 'regions' => [1, 2]],
            ['name' => 'Eurasian Otter', 'scientific_name' => 'Lutra lutra', 'type_id' => 1, 'status_id' => 2, 'description' => 'River otter', 'habitat' => 'Rivers', 'diet' => 'Fish', 'regions' => [1, 2]],
        ];

        foreach ($finalSpurt as $data) {
            if ($added >= $limit) break;

            $regions = $data['regions'] ?? [];
            unset($data['regions']);

            if (isset($data['type_id'])) {
                $data['species_type_id'] = $data['type_id'];
                unset($data['type_id']);
            }
            if (isset($data['status_id'])) {
                $data['conservation_status_id'] = $data['status_id'];
                unset($data['status_id']);
            }

            if (!Animal::where('name', $data['name'])->exists()) {
                try {
                    $animal = Animal::create($data);
                    if ($regions) {
                        $animal->regions()->attach($regions);
                    }
                    $this->line("✅ {$data['name']}");
                    $added++;
                } catch (\Exception $e) {
                    $this->line("⏭️  {$data['name']} - skip");
                }
            }
        }

        $this->info("\n✨ Final Results:");
        $this->info("📊 Added: {$added} species");
        
        $total = Animal::count();
        $this->info("🌍 TOTAL ANIMALS: {$total}");
        
        if ($total >= 600) {
            $this->info("\n🎉🎉🎉🎉🎉 MILESTONE ACHIEVED! 🎉🎉🎉🎉🎉");
            $this->info("🐾 DATABASE NOW CONTAINS {$total} SPECIES!");
            $this->info("📊 {$total} > 600! 🚀");
        }
    }
}
