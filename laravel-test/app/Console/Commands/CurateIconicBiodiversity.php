<?php

namespace App\Console\Commands;

use App\Models\Animal;
use Illuminate\Console\Command;

class CurateIconicBiodiversity extends Command
{
    protected $signature = 'biodiversity:curate';
    protected $description = 'Keep only iconic/representative species for clean map';

    public function handle()
    {
        $this->info('🔍 Curating biodiversity to iconic species...');
        $this->info('Current total: ' . Animal::count() . ' species');
        
        // Species to KEEP - iconic representatives only
        $iconic = [
            // Primates
            'Sumatran Orangutan', 'Javan Gibbon', 'Proboscis Monkey', 'Macaque',
            // Big Cats
            'Sumatran Tiger', 'Clouded Leopard', 'Asian Leopard Cat', 'Flat-headed Cat',
            // Bears
            'Sun Bear', 'Asian Black Bear',
            // Elephants
            'Sumatran Elephant', 'Asian Elephant',
            // Rhinos
            'Sumatran Rhinoceros', 'Javan Rhinoceros',
            // Deer & Ungulates
            'Sambar Deer', 'Barking Deer', 'Chevrotain', 'Wild Boar',
            // Birds - Raptors
            'Philippine Eagle', 'White-tailed Eagle', 'Harpy Eagle', 'Serpent Eagle',
            // Birds - Owls
            'Barn Owl', 'Spotted Eagle-Owl', 'Asian Grass Owl',
            // Birds - Hornbills
            'Rhinoceros Hornbill', 'Pied Hornbill', 'Great Hornbill',
            // Birds - Parrots
            'Red-capped Parrot', 'Blue-winged Parrot', 'Sulphur-crested Cockatoo',
            // Birds - Kingfishers
            'Common Kingfisher', 'Crested Kingfisher', 'Stork-billed Kingfisher',
            // Birds - Others
            'Peacock', 'Wild Chicken', 'Pheasant', 'Cuckoo', 'Woodpecker', 'Sunbird',
            // Reptiles
            'Komodo Dragon', 'Reticulated Python', 'King Cobra', 'Green Sea Turtle',
            'Saltwater Crocodile', 'Gharial', 'Monitor Lizard', 'Flying Dragon',
            // Amphibians
            'Poison Dart Frog', 'Tree Frog', 'Bullfrog',
            // Fish
            'Clownfish', 'Great White Shark', 'Manta Ray', 'Seahorse', 'Lionfish',
            'Tuna', 'Sailfish', 'Grouper',
            // Marine Mammals
            'Bottlenose Dolphin', 'Spinner Dolphin', 'Humpback Whale', 'Blue Whale',
            'Sperm Whale', 'Sea Lion', 'Seal',
            // Insects - Butterflies
            'Monarch Butterfly', 'Blue Morpho', 'Rajah Brooke\'s Birdwing', 'Queen Alexandra\'s Parrot',
            // Insects - Others
            'Dragonfly', 'Damselfly', 'Grasshopper', 'Cricket', 'Beetle', 'Ant', 'Bee', 'Wasp',
            // Arachnids
            'Tarantula', 'Jumping Spider', 'Scorpion',
            // Marine Life
            'Sea Star', 'Brittle Star', 'Crown-of-thorns Starfish', 'Sea Cucumber', 'Sea Urchin',
            // Carnivores
            'Weasel', 'Stoat', 'Otter', 'Mongoose', 'Civets',
            // Small Mammals
            'Flying Lemur', 'Squirrel', 'Flying Squirrel', 'Porcupine', 'Pangolin',
            // Bats
            'Fruit Bat', 'Vampire Bat', 'Horseshoe Bat',
            // Seabirds
            'Heron', 'Egret', 'Stork', 'Duck', 'Swan', 'Cormorant', 'Pelican',
            // Waders
            'Crane', 'Flamingo', 'Stilt', 'Curlew',
            // Others
            'Wolf', 'Fox', 'Jackal', 'Hyena', 'Badger',
        ];

        // Get current animals grouped by scientific name to find duplicates
        $allAnimals = Animal::all();
        $kept = 0;
        $deleted = 0;
        
        foreach ($allAnimals as $animal) {
            // Check if animal name is in iconic list (case-insensitive)
            $isIconic = false;
            foreach ($iconic as $iconicName) {
                if (stripos($animal->name, $iconicName) !== false || 
                    stripos($iconicName, $animal->name) !== false) {
                    $isIconic = true;
                    break;
                }
            }
            
            if (!$isIconic) {
                // Delete non-iconic animals
                $animal->regions()->detach();
                $animal->seaZones()->detach();
                $animal->delete();
                $deleted++;
                $this->line("❌ Removed: {$animal->name}");
            } else {
                $kept++;
            }
        }
        
        $final = Animal::count();
        $this->info("\n✨ CURATION COMPLETE:");
        $this->info("🧬 Kept iconic species: {$kept}");
        $this->info("🗑️  Removed cluttered species: {$deleted}");
        $this->info("🌍 FINAL CURATED COUNT: {$final} iconic species");
        
        if ($final <= 200) {
            $this->info("\n✅ Perfect! Map will be clean and beautiful now.");
        }
    }
}
