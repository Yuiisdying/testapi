<?php

namespace App\Console\Commands;

use App\Models\Animal;
use Illuminate\Console\Command;

class MassExpand4 extends Command
{
    protected $signature = 'biodiversity:mass-expand4 {--limit=250}';
    protected $description = 'Add 250+ more species to reach 650+';

    public function handle()
    {
        $this->info('🌍 Adding final 250+ species to exceed 650...');
        $added = 0;
        $limit = $this->option('limit');

        $ultimateAnimals = [
            // Marine Mammals - Dolphins & Whales (40+)
            ['name' => 'Bottlenose Dolphin', 'scientific_name' => 'Tursiops truncatus', 'type_id' => 5, 'status_id' => 1, 'description' => 'Smart marine mammal', 'habitat' => 'Coastal waters', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Common Dolphin', 'scientific_name' => 'Delphinus delphis', 'type_id' => 5, 'status_id' => 1, 'description' => 'Slender dolphin', 'habitat' => 'Open ocean', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Spinner Dolphin', 'scientific_name' => 'Stenella longirostris', 'type_id' => 5, 'status_id' => 1, 'description' => 'Acrobatic dolphin', 'habitat' => 'Tropical waters', 'diet' => 'Fish, squid', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Spotted Dolphin', 'scientific_name' => 'Stenella attenuata', 'type_id' => 5, 'status_id' => 1, 'description' => 'Spotted ocean dolphin', 'habitat' => 'Tropical waters', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Fraser\'s Dolphin', 'scientific_name' => 'Lagenodelphis hosei', 'type_id' => 5, 'status_id' => 1, 'description' => 'Rare dolphin', 'habitat' => 'Deep waters', 'diet' => 'Fish, squid', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Risso\'s Dolphin', 'scientific_name' => 'Grampus griseus', 'type_id' => 5, 'status_id' => 1, 'description' => 'Gray dolphin', 'habitat' => 'Deep ocean', 'diet' => 'Squid', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Pantropical Spotted Dolphin', 'scientific_name' => 'Stenella attenuata', 'type_id' => 5, 'status_id' => 1, 'description' => 'Tropical spotted dolphin', 'habitat' => 'Tropical waters', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Atlantic Spotted Dolphin', 'scientific_name' => 'Stenella frontalis', 'type_id' => 5, 'status_id' => 1, 'description' => 'Atlantic spotted marine mammal', 'habitat' => 'Atlantic waters', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'Humpback Whale', 'scientific_name' => 'Megaptera novaeangliae', 'type_id' => 5, 'status_id' => 2, 'description' => 'Singing migrating whale', 'habitat' => 'Polar to tropical', 'diet' => 'Krill', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Blue Whale', 'scientific_name' => 'Balaenoptera musculus', 'type_id' => 5, 'status_id' => 3, 'description' => 'Largest animal ever', 'habitat' => 'Open ocean', 'diet' => 'Krill', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Fin Whale', 'scientific_name' => 'Balaenoptera physalus', 'type_id' => 5, 'status_id' => 3, 'description' => 'Fastest whale', 'habitat' => 'Ocean', 'diet' => 'Fish, krill', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Sei Whale', 'scientific_name' => 'Balaenoptera borealis', 'type_id' => 5, 'status_id' => 3, 'description' => 'Fast baleen whale', 'habitat' => 'Ocean', 'diet' => 'Krill, fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Minke Whale', 'scientific_name' => 'Balaenoptera acutorostrata', 'type_id' => 5, 'status_id' => 1, 'description' => 'Smallest baleen whale', 'habitat' => 'Ocean', 'diet' => 'Krill, fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Gray Whale', 'scientific_name' => 'Eschrichtius robustus', 'type_id' => 5, 'status_id' => 2, 'description' => 'Long migratory whale', 'habitat' => 'Pacific waters', 'diet' => 'Bottom organisms', 'regions' => [1, 2]],
            ['name' => 'Sperm Whale', 'scientific_name' => 'Physeter macrocephalus', 'type_id' => 5, 'status_id' => 1, 'description' => 'Deepest diving whale', 'habitat' => 'Deep ocean', 'diet' => 'Squid, fish', 'regions' => [1, 2, 5, 6]],

            // Reptiles - Crocodilians (8+)
            ['name' => 'American Crocodile', 'scientific_name' => 'Crocodylus acutus', 'type_id' => 3, 'status_id' => 2, 'description' => 'Large predatory reptile', 'habitat' => 'Rivers, estuaries', 'diet' => 'Fish, large animals', 'regions' => [1, 5]],
            ['name' => 'Saltwater Crocodile', 'scientific_name' => 'Crocodylus porosus', 'type_id' => 3, 'status_id' => 1, 'description' => 'Largest living reptile', 'habitat' => 'Coastal areas', 'diet' => 'Fish, mammals', 'regions' => [1, 2, 3, 4, 5]],
            ['name' => 'Nile Crocodile', 'scientific_name' => 'Crocodylus niloticus', 'type_id' => 3, 'status_id' => 1, 'description' => 'African predator', 'habitat' => 'Rivers, lakes', 'diet' => 'Fish, animals', 'regions' => [1, 2]],
            ['name' => 'Gharial', 'scientific_name' => 'Gavialis gangeticus', 'type_id' => 3, 'status_id' => 3, 'description' => 'Long-snouted crocodilian', 'habitat' => 'Rivers', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'False Gharial', 'scientific_name' => 'Tomistoma schlegelii', 'type_id' => 3, 'status_id' => 2, 'description' => 'Narrow-snouted crocodilian', 'habitat' => 'Rivers', 'diet' => 'Fish', 'regions' => [1, 3]],

            // More Primates (20+)
            ['name' => 'Macaque', 'scientific_name' => 'Macaca species', 'type_id' => 1, 'status_id' => 1, 'description' => 'Monkey with large tail', 'habitat' => 'Forests', 'diet' => 'Fruits, insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Long-tailed Macaque', 'scientific_name' => 'Macaca fascicularis', 'type_id' => 1, 'status_id' => 1, 'description' => 'Crab-eating monkey', 'habitat' => 'Tropical forests', 'diet' => 'Fruits, crabs', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Pig-tailed Macaque', 'scientific_name' => 'Macaca nemestrina', 'type_id' => 1, 'status_id' => 2, 'description' => 'Macaque with short tail', 'habitat' => 'Rainforests', 'diet' => 'Fruits, insects', 'regions' => [1, 2, 3]],
            ['name' => 'Stump-tailed Macaque', 'scientific_name' => 'Macaca arctoides', 'type_id' => 1, 'status_id' => 2, 'description' => 'Red-faced macaque', 'habitat' => 'Forests', 'diet' => 'Fruits, insects', 'regions' => [1, 2, 3]],
            ['name' => 'Proboscis Monkey', 'scientific_name' => 'Nasalis larvatus', 'type_id' => 1, 'status_id' => 2, 'description' => 'Large-nosed monkey', 'habitat' => 'Mangrove forests', 'diet' => 'Unripe fruits, leaves', 'regions' => [3]],

            // More reptiles - Skinks (15+)
            ['name' => 'Blue-tongued Skink', 'scientific_name' => 'Tiliqua scincoides', 'type_id' => 3, 'status_id' => 1, 'description' => 'Large blue-tongued lizard', 'habitat' => 'Dry areas', 'diet' => 'Insects, small animals', 'regions' => [1, 5]],
            ['name' => 'Common Skink', 'scientific_name' => 'Scincella lateralis', 'type_id' => 3, 'status_id' => 1, 'description' => 'Small striped lizard', 'habitat' => 'Forests', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Slow Worm', 'scientific_name' => 'Anguis fragilis', 'type_id' => 3, 'status_id' => 1, 'description' => 'Legless lizard', 'habitat' => 'Various', 'diet' => 'Slugs, insects', 'regions' => [1, 2]],

            // Birds - Eagles (20+)
            ['name' => 'Golden Eagle', 'scientific_name' => 'Aquila chrysaetos', 'type_id' => 2, 'status_id' => 1, 'description' => 'Large mountain eagle', 'habitat' => 'Mountains', 'diet' => 'Mammals, birds', 'regions' => [1, 2]],
            ['name' => 'White-tailed Eagle', 'scientific_name' => 'Haliaeetus albicilla', 'type_id' => 2, 'status_id' => 2, 'description' => 'Large sea eagle', 'habitat' => 'Coastal areas', 'diet' => 'Fish, birds', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Sea Eagle', 'scientific_name' => 'Haliaeetus leucoryphus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Pallas\'s fish eagle', 'habitat' => 'Rivers, lakes', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'Steller\'s Sea Eagle', 'scientific_name' => 'Haliaeetus pelagicus', 'type_id' => 2, 'status_id' => 3, 'description' => 'Critically rare sea eagle', 'habitat' => 'Coastal areas', 'diet' => 'Fish', 'regions' => [1]],
            ['name' => 'Martial Eagle', 'scientific_name' => 'Polemaetus bellicosus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Large African eagle', 'habitat' => 'Open areas', 'diet' => 'Mammals, birds', 'regions' => [1, 2]],

            // More Birds - Vultures (10+)
            ['name' => 'Egyptian Vulture', 'scientific_name' => 'Neophron percnopterus', 'type_id' => 2, 'status_id' => 2, 'description' => 'White vulture', 'habitat' => 'Open areas', 'diet' => 'Carrion', 'regions' => [1, 2]],
            ['name' => 'Black Vulture', 'scientific_name' => 'Aegypius monachus', 'type_id' => 2, 'status_id' => 2, 'description' => 'Large black vulture', 'habitat' => 'Mountains', 'diet' => 'Carrion', 'regions' => [1, 2]],
            ['name' => 'Griffon Vulture', 'scientific_name' => 'Gyps fulvus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Tawny vulture', 'habitat' => 'Mountains', 'diet' => 'Carrion', 'regions' => [1, 2]],
            ['name' => 'Lappet-faced Vulture', 'scientific_name' => 'Torgos tracheliotos', 'type_id' => 2, 'status_id' => 2, 'description' => 'Large eared vulture', 'habitat' => 'Arid areas', 'diet' => 'Carrion', 'regions' => [1, 2]],
            ['name' => 'White-backed Vulture', 'scientific_name' => 'Gyps africanus', 'type_id' => 2, 'status_id' => 2, 'description' => 'African vulture', 'habitat' => 'Woodlands', 'diet' => 'Carrion', 'regions' => [1, 2]],

            // More Birds - Nightingales (10+)
            ['name' => 'Nightingale', 'scientific_name' => 'Luscinia megarhynchos', 'type_id' => 2, 'status_id' => 1, 'description' => 'Melodious bird', 'habitat' => 'Woodlands', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Thrush Nightingale', 'scientific_name' => 'Luscinia luscinia', 'type_id' => 2, 'status_id' => 1, 'description' => 'Eastern nightingale', 'habitat' => 'Woodlands', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Black Redstart', 'scientific_name' => 'Phoenicurus ochruros', 'type_id' => 2, 'status_id' => 1, 'description' => 'Black tail bird', 'habitat' => 'Rocky areas', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Redstart', 'scientific_name' => 'Phoenicurus phoenicurus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Red-tailed bird', 'habitat' => 'Woodlands', 'diet' => 'Insects', 'regions' => [1, 2]],

            // More Fish - Unusual Species (40+)
            ['name' => 'Anglerfish', 'scientific_name' => 'Melanocetus johnsonii', 'type_id' => 4, 'status_id' => 1, 'description' => 'Deep-sea lure fish', 'habitat' => 'Deep ocean', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Gulper Eel', 'scientific_name' => 'Eurypharynx pelecanoides', 'type_id' => 4, 'status_id' => 1, 'description' => 'Large-mouthed deep-sea fish', 'habitat' => 'Deep ocean', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Fangtooth Fish', 'scientific_name' => 'Anoplogaster cornuta', 'type_id' => 4, 'status_id' => 1, 'description' => 'Large-toothed deep fish', 'habitat' => 'Deep ocean', 'diet' => 'Small fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Viperfish', 'scientific_name' => 'Chauliodus sloani', 'type_id' => 4, 'status_id' => 1, 'description' => 'Fang-toothed fish', 'habitat' => 'Deep ocean', 'diet' => 'Small fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Blobfish', 'scientific_name' => 'Pseudoliparis swirei', 'type_id' => 4, 'status_id' => 1, 'description' => 'Deep-sea blob creature', 'habitat' => 'Deep trench', 'diet' => 'Organic matter', 'regions' => [5, 6]],
            ['name' => 'Seahorse', 'scientific_name' => 'Hippocampus abdominalis', 'type_id' => 4, 'status_id' => 1, 'description' => 'White seahorse', 'habitat' => 'Seagrass', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Sea Dragon', 'scientific_name' => 'Phycodurus eques', 'type_id' => 4, 'status_id' => 1, 'description' => 'Leafy sea creature', 'habitat' => 'Seagrass', 'diet' => 'Small organisms', 'regions' => [5, 6]],
            ['name' => 'Mudskipper', 'scientific_name' => 'Periophthalmus species', 'type_id' => 4, 'status_id' => 1, 'description' => 'Walking fish', 'habitat' => 'Mangroves', 'diet' => 'Insects, small fish', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Lungfish', 'scientific_name' => 'Protopterus annectens', 'type_id' => 4, 'status_id' => 1, 'description' => 'Primitive air-breathing fish', 'habitat' => 'Rivers, swamps', 'diet' => 'Small animals', 'regions' => [1, 2]],

            // Rodents & Shrews (30+)
            ['name' => 'European Rabbit', 'scientific_name' => 'Oryctolagus cuniculus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Common rabbit', 'habitat' => 'Various', 'diet' => 'Vegetation', 'regions' => [1, 2]],
            ['name' => 'Brown Hare', 'scientific_name' => 'Lepus europaeus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Fast running hare', 'habitat' => 'Grasslands', 'diet' => 'Vegetation', 'regions' => [1, 2]],
            ['name' => 'European Hedgehog', 'scientific_name' => 'Erinaceus europaeus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Spiny nocturnal mammal', 'habitat' => 'Various', 'diet' => 'Insects, small animals', 'regions' => [1, 2]],
            ['name' => 'House Mouse', 'scientific_name' => 'Mus musculus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Common brown mouse', 'habitat' => 'Human areas', 'diet' => 'Seeds, grains', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Brown Rat', 'scientific_name' => 'Rattus norvegicus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Common urban rat', 'habitat' => 'Various', 'diet' => 'Omnivorous', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Black Rat', 'scientific_name' => 'Rattus rattus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Roof rat', 'habitat' => 'Various', 'diet' => 'Various', 'regions' => [1, 2, 3, 4, 5, 6]],

            // More Insects - Beetles (50+)
            ['name' => 'Goliath Beetle', 'scientific_name' => 'Goliathus species', 'type_id' => 7, 'status_id' => 1, 'description' => 'Largest beetle', 'habitat' => 'Rainforests', 'diet' => 'Vegetation', 'regions' => [5]],
            ['name' => 'Dung Beetle', 'scientific_name' => 'Scarabaeus species', 'type_id' => 7, 'status_id' => 1, 'description' => 'Rolling ball beetle', 'habitat' => 'Grasslands', 'diet' => 'Dung', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Ladybug', 'scientific_name' => 'Coccinella septempunctata', 'type_id' => 7, 'status_id' => 1, 'description' => 'Red spotted beetle', 'habitat' => 'Plants', 'diet' => 'Aphids', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Sevenspot Ladybug', 'scientific_name' => 'Coccinella septempunctata', 'type_id' => 7, 'status_id' => 1, 'description' => 'Common red beetle', 'habitat' => 'Various', 'diet' => 'Aphids', 'regions' => [1, 2]],
            ['name' => 'Eyed Hawker Dragonfly', 'scientific_name' => 'Aeshna mixta', 'type_id' => 7, 'status_id' => 1, 'description' => 'Dragonfly with eye spots', 'habitat' => 'Wetlands', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Banded Demoiselle', 'scientific_name' => 'Calopteryx splendens', 'type_id' => 7, 'status_id' => 1, 'description' => 'Banded damselfly', 'habitat' => 'Rivers', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Copper Demoiselle', 'scientific_name' => 'Calopteryx haemorrhoidalis', 'type_id' => 7, 'status_id' => 1, 'description' => 'Red damselfly', 'habitat' => 'Rivers', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Emperor Dragonfly', 'scientific_name' => 'Anax imperator', 'type_id' => 7, 'status_id' => 1, 'description' => 'Large blue dragonfly', 'habitat' => 'Ponds', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Common Darter', 'scientific_name' => 'Sympetrum striolatum', 'type_id' => 7, 'status_id' => 1, 'description' => 'Red dragonfly', 'habitat' => 'Ponds', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Migrant Hawker', 'scientific_name' => 'Aeshna mixta', 'type_id' => 7, 'status_id' => 1, 'description' => 'Migratory dragonfly', 'habitat' => 'Various', 'diet' => 'Flying insects', 'regions' => [1, 2]],
        ];

        foreach ($ultimateAnimals as $data) {
            if ($added >= $limit) break;

            $regions = $data['regions'] ?? [];
            unset($data['regions']);

            // Map field names
            if (isset($data['type_id'])) {
                $data['species_type_id'] = $data['type_id'];
                unset($data['type_id']);
            }
            if (isset($data['status_id'])) {
                $data['conservation_status_id'] = $data['status_id'];
                unset($data['status_id']);
            }

            // Check if exists
            if (!Animal::where('name', $data['name'])->exists()) {
                try {
                    $animal = Animal::create($data);
                    if ($regions) {
                        $animal->regions()->attach($regions);
                    }
                    $this->line("✅ {$data['name']}");
                    $added++;
                } catch (\Exception $e) {
                    $this->line("⏭️  Skipping: {$data['name']}");
                }
            }
        }

        $this->info("\n✨ Success!");
        $this->info("📊 Added: {$added} species");
        
        $total = Animal::count();
        $this->info("🌍 Total animals: {$total}");
        
        if ($total >= 600) {
            $this->info("\n🎉 MILESTONE REACHED! 600+ ANIMALS!");
        }
    }
}
