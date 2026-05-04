<?php

namespace App\Console\Commands;

use App\Models\Animal;
use Illuminate\Console\Command;

class FixSpeciesTypes extends Command
{
    protected $signature = 'biodiversity:fix-types';
    protected $description = 'Fix misclassified species types';

    public function handle()
    {
        $this->info('🔧 Fixing species type classifications...');

        // Map of wrong type_id -> correct type_id
        $fixes = [
            // Anything classified as 4 (Amphibian) that's actually Fish should be 5
            // Anything classified as 5 (Fish) should actually be Fish (correct)
            // Anything classified as 6 (Marine) should stay 6
        ];

        // Find all Fish mistakenly classified as Amphibian (type_id 4)
        $fishNames = [
            'Clownfish', 'Sailfish', 'Marlin', 'Tuna', 'Yellowfin Tuna', 'Swordfish', 
            'Barracuda', 'Jack Fish', 'Cod', 'Salmon', 'Herring', 'Sardine', 'Anchovy',
            'Bass', 'Haddock', 'Mackerel', 'Bonito', 'Plaice', 'Sole', 'Flounder', 'Halibut',
            'Turbot', 'Grouper', 'Snapper', 'Trevally', 'Wahoo', 'King Mackerel', 'Pufferfish',
            'Stonefish', 'Flying Fish', 'Arapaima', 'Piranha', 'Catfish', 'Carp', 'Koi',
            'Goldfish', 'Trout', 'Eel', 'Lamprey', 'Tarpon', 'Bonito', 'Mackerel',
            'Herring', 'Sardine', 'Anchovy', 'Bass', 'Haddock', 'Mudskipper', 'Lungfish',
            'Dolphin Fish', 'Pompano', 'Permit', 'Jacks', 'Wrasse', 'Angelfish', 'Butterflyfish',
            'Damselfish', 'Goby', 'Triggerfish', 'Filefish', 'Blenny', 'Pipefish', 'Dragonet',
            'Jawfish', 'Mandarin Fish', 'Dottyback', 'Chromis', 'Cardinalfish', 'Trumpetfish',
            'Cornetfish', 'Shrimpfish', 'Garden Eel', 'Frogfish', 'Boxfish'
        ];

        $fixed = 0;
        foreach ($fishNames as $name) {
            $count = Animal::where('name', 'like', "%{$name}%")
                ->where('species_type_id', 4)  // Currently Amphibian
                ->update(['species_type_id' => 5]); // Change to Fish
            
            if ($count > 0) {
                $this->line("✓ Fixed {$count} '{$name}' from Amphibian to Fish");
                $fixed += $count;
            }
        }

        // Count current types
        $this->info("\n=== CURRENT CLASSIFICATION ===");
        $typeCounts = Animal::groupBy('species_type_id')
            ->selectRaw('species_type_id, count(*) as count')
            ->with('speciesType')
            ->get();

        foreach ($typeCounts as $count) {
            echo $count->speciesType->name . ": " . $count->count . "\n";
        }

        $this->info("\n✅ Fixed {$fixed} misclassified species!");
    }
}
