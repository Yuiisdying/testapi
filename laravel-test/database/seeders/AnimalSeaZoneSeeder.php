<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\SeaZone;
use Illuminate\Database\Seeder;

class AnimalSeaZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Helper function to link animals to sea zones
        $link = function ($animalName, $seaZoneNames) {
            $animal = Animal::where('name', $animalName)->first();
            if ($animal) {
                foreach ($seaZoneNames as $seaZoneName) {
                    $seaZone = SeaZone::where('name', $seaZoneName)->first();
                    if ($seaZone) {
                        $animal->seaZones()->syncWithoutDetaching([$seaZone->id]);
                    }
                }
            }
        };

        // Whale Shark - found in all tropical SE Asian waters
        $link('Whale Shark', [
            'Java Sea',
            'Andaman Sea',
            'South China Sea',
            'Sulu Sea',
        ]);

        // Great White Shark - wider distribution
        $link('Great White Shark', [
            'Timor Sea',
            'Arafura Sea',
            'South China Sea (Malaysia)',
        ]);

        // Scalloped Hammerhead - found in Coral Triangle
        $link('Scalloped Hammerhead', [
            'Andaman Sea',
            'South China Sea',
            'Sulu Sea',
            'Celebes Sea',
        ]);

        // Leatherback Sea Turtle - nesting in Indonesia, migration routes
        $link('Leatherback Sea Turtle', [
            'Java Sea',
            'Banda Sea',
            'Timor Sea',
            'Arafura Sea',
        ]);

        // Green Sea Turtle - widespread in tropical waters
        $link('Green Sea Turtle', [
            'Java Sea',
            'Flores Sea',
            'Sulawesi Sea',
            'Andaman Sea',
            'South China Sea',
        ]);

        // Hawksbill Sea Turtle - reef dweller
        $link('Hawksbill Sea Turtle', [
            'Andaman Sea',
            'South China Sea',
            'Sulu Sea',
            'Celebes Sea',
        ]);

        // Indo-Pacific Humpback Dolphin - coastal SE Asia
        $link('Indo-Pacific Humpback Dolphin', [
            'South China Sea',
            'South China Sea (Malaysia)',
            'Gulf of Thailand',
        ]);

        // Irrawaddy Dolphin - Mekong and SE Asian rivers/coasts
        $link('Irrawaddy Dolphin', [
            'Bay of Bengal',
            'Gulf of Thailand',
            'South China Sea',
        ]);

        // Humpback Whale - migration routes
        $link('Humpback Whale', [
            'Andaman Sea',
            'Bay of Bengal',
            'Indian Ocean waters',
        ]);

        // Sperm Whale - deep ocean dweller
        $link('Sperm Whale', [
            'Banda Sea',
            'Celebes Sea',
            'Timor Sea',
        ]);

        // Giant Manta Ray - all tropical waters
        $link('Giant Manta Ray', [
            'Andaman Sea',
            'South China Sea',
            'Sulu Sea',
            'Java Sea',
        ]);

        // Sawfish - shallow coastal waters
        $link('Sawfish', [
            'Straits of Malacca',
            'South China Sea (Malaysia)',
            'Gulf of Thailand',
        ]);

        // Giant Pacific Octopus - deep waters
        $link('Giant Pacific Octopus', [
            'Banda Sea',
            'Celebes Sea',
            'Arafura Sea',
        ]);

        // Giant Squid - deep ocean
        $link('Giant Squid', [
            'Banda Sea',
            'South China Sea',
            'Bay of Bengal',
        ]);

        // Horseshoe Crab - mudflats
        $link('Horseshoe Crab', [
            'Straits of Malacca',
            'South China Sea (Malaysia)',
            'Gulf of Thailand',
        ]);

        // Coconut Crab - island coasts
        $link('Coconut Crab', [
            'Java Sea',
            'Banda Sea',
            'Sulu Sea',
        ]);

        // Staghorn Coral - reef builder
        $link('Staghorn Coral', [
            'Andaman Sea',
            'South China Sea',
            'Sulu Sea',
        ]);

        // Brain Coral - reefs
        $link('Brain Coral', [
            'Andaman Sea',
            'Coral Triangle waters',
        ]);

        // Manatee - estuaries (less common in Indonesia, more Caribbean)
        $link('Manatee', [
            'Bay of Bengal',
        ]);

        // Dugong - seagrass meadows across SE Asia
        $link('Dugong', [
            'Java Sea',
            'Sulawesi Sea',
            'Andaman Sea',
            'South China Sea',
            'South China Sea (Malaysia)',
        ]);

        // Saltwater Crocodile - coastal SE Asia
        $link('Saltwater Crocodile', [
            'Java Sea',
            'Sulawesi Sea',
            'Celebes Sea',
            'Sulu Sea',
        ]);
    }
}
