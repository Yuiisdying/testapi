<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Seeder;

class MarineAnimalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marineAnimals = [
            // Sharks
            [
                'name' => 'Whale Shark',
                'scientific_name' => 'Rhincodon typus',
                'common_name' => 'World\'s largest fish',
                'description' => 'The whale shark is the largest living fish species. Despite their massive size, they are gentle filter-feeders that consume plankton and small fish. These gentle giants migrate across tropical seas.',
                'species_type_id' => 4, // Fish
                'conservation_status_id' => 3, // Endangered
                'habitat' => 'Open ocean, tropical waters',
                'diet' => 'Plankton, fish eggs, small fish',
                'estimated_population' => 210000,
            ],
            [
                'name' => 'Great White Shark',
                'scientific_name' => 'Carcharodon carcharias',
                'common_name' => 'White shark, great white',
                'description' => 'The great white shark is an iconic apex predator known for its size and power. They are found in cooler waters and migrate across thousands of kilometers.',
                'species_type_id' => 4, // Fish
                'conservation_status_id' => 2, // Vulnerable
                'habitat' => 'Temperate and tropical oceans',
                'diet' => 'Large fish, marine mammals, seals',
                'estimated_population' => 3500,
            ],
            [
                'name' => 'Scalloped Hammerhead',
                'scientific_name' => 'Sphyrna lewini',
                'common_name' => 'Hammerhead shark',
                'description' => 'Named for their distinctive head shape, hammerheads use their wide head as a scanning tool to locate prey using electromagnetic sensors.',
                'species_type_id' => 4, // Fish
                'conservation_status_id' => 3, // Endangered
                'habitat' => 'Coastal waters, open ocean',
                'diet' => 'Small fish, squid, crustaceans',
                'estimated_population' => 5000000,
            ],

            // Sea Turtles
            [
                'name' => 'Leatherback Sea Turtle',
                'scientific_name' => 'Dermochelys coriacea',
                'common_name' => 'Leatherback turtle',
                'description' => 'The largest sea turtle species, capable of diving deeper than any other sea turtle. They migrate across entire ocean basins, from Indonesia to California.',
                'species_type_id' => 3, // Reptile
                'conservation_status_id' => 4, // Critically Endangered
                'habitat' => 'Open ocean, nesting beaches in Indonesia',
                'diet' => 'Jellyfish, sea cucumbers',
                'estimated_population' => 34500,
            ],
            [
                'name' => 'Green Sea Turtle',
                'scientific_name' => 'Chelonia mydas',
                'common_name' => 'Green turtle',
                'description' => 'Named for the greenish color of their fat, green sea turtles migrate thousands of kilometers between feeding grounds and nesting beaches.',
                'species_type_id' => 3, // Reptile
                'conservation_status_id' => 3, // Endangered
                'habitat' => 'Tropical and subtropical oceans',
                'diet' => 'Seagrass, algae, jellyfish',
                'estimated_population' => 15000000,
            ],

            // Dolphins & Whales
            [
                'name' => 'Indo-Pacific Humpback Dolphin',
                'scientific_name' => 'Sousa chinensis',
                'common_name' => 'Chinese white dolphin, humpback dolphin',
                'description' => 'Known for their distinctive hump and playful behavior, these dolphins are commonly found in Asian coastal waters including the South China Sea.',
                'species_type_id' => 5, // Marine
                'conservation_status_id' => 3, // Endangered
                'habitat' => 'Coastal waters, estuaries',
                'diet' => 'Small fish, squid',
                'estimated_population' => 2000,
            ],
            [
                'name' => 'Irrawaddy Dolphin',
                'scientific_name' => 'Orcaella brevirostris',
                'common_name' => 'Irrawaddy dolphin',
                'description' => 'These river and coastal dolphins are found in Southeast Asian waters. They have a rounded head and are known for their gentle nature.',
                'species_type_id' => 5, // Marine
                'conservation_status_id' => 4, // Critically Endangered
                'habitat' => 'Rivers, estuaries, coastal areas',
                'diet' => 'Small fish, crustaceans',
                'estimated_population' => 400,
            ],
            [
                'name' => 'Humpback Whale',
                'scientific_name' => 'Megaptera novaeangliae',
                'common_name' => 'Humpback whale',
                'description' => 'Famous for their spectacular breaching and complex songs, humpback whales migrate between Arctic feeding grounds and tropical breeding areas.',
                'species_type_id' => 5, // Marine
                'conservation_status_id' => 1, // Least Concern
                'habitat' => 'Open ocean, polar and tropical waters',
                'diet' => 'Krill, small fish',
                'estimated_population' => 135000,
            ],
            [
                'name' => 'Sperm Whale',
                'scientific_name' => 'Physeter macrocephalus',
                'common_name' => 'Sperm whale, cachalot',
                'description' => 'The largest toothed whale and deepest diving cetacean, capable of diving over 7000 meters to hunt giant squid.',
                'species_type_id' => 5, // Marine
                'conservation_status_id' => 2, // Vulnerable
                'habitat' => 'Deep ocean waters',
                'diet' => 'Giant squid, fish',
                'estimated_population' => 409000,
            ],

            // Rays & Skates
            [
                'name' => 'Giant Manta Ray',
                'scientific_name' => 'Manta birostris',
                'common_name' => 'Manta ray, devil ray',
                'description' => 'The largest ray species, manta rays are graceful swimmers known for their acrobatic leaping. They feed on plankton and are found in all tropical oceans.',
                'species_type_id' => 4, // Fish
                'conservation_status_id' => 3, // Endangered
                'habitat' => 'Tropical and subtropical oceans',
                'diet' => 'Plankton, small fish',
                'estimated_population' => 1500000,
            ],
            [
                'name' => 'Sawfish',
                'scientific_name' => 'Pristis pristis',
                'common_name' => 'Largetooth sawfish',
                'description' => 'One of the most critically endangered marine species, sawfish are distinctive for their saw-like snout used for hunting.',
                'species_type_id' => 4, // Fish
                'conservation_status_id' => 4, // Critically Endangered
                'habitat' => 'Shallow coastal waters, estuaries',
                'diet' => 'Small fish, crustaceans',
                'estimated_population' => 500,
            ],

            // Cephalopods
            [
                'name' => 'Giant Pacific Octopus',
                'scientific_name' => 'Enteroctopus dofleini',
                'common_name' => 'Giant octopus',
                'description' => 'The largest octopus species, capable of weighing over 100 kg. Despite their intelligence, little is known about their behavior in the wild.',
                'species_type_id' => 4, // Fish
                'conservation_status_id' => 1, // Least Concern
                'habitat' => 'Deep ocean floors, caves',
                'diet' => 'Crabs, fish, other mollusks',
                'estimated_population' => 9000000,
            ],
            [
                'name' => 'Giant Squid',
                'scientific_name' => 'Architeuthis dux',
                'common_name' => 'Giant squid',
                'description' => 'One of the most enigmatic sea creatures, giant squid live in the deep ocean and are rarely seen. They are the primary prey of sperm whales.',
                'species_type_id' => 4, // Fish
                'conservation_status_id' => 1, // Least Concern (Data Deficient, but Least Concern default)
                'habitat' => 'Deep ocean, 300-900m depth',
                'diet' => 'Fish, other cephalopods',
                'estimated_population' => 5000000,
            ],

            // Corals
            [
                'name' => 'Staghorn Coral',
                'scientific_name' => 'Acropora cervicornis',
                'common_name' => 'Staghorn coral',
                'description' => 'A critical reef-building coral, staghorn corals are among the fastest-growing corals and form extensive branching colonies.',
                'species_type_id' => 7, // Insect (placeholder for corals)
                'conservation_status_id' => 4, // Critically Endangered
                'habitat' => 'Coral reefs, shallow waters',
                'diet' => 'Symbiotic algae (photosynthesis)',
                'estimated_population' => 20000000,
            ],
            [
                'name' => 'Brain Coral',
                'scientific_name' => 'Diploria labyrinthiformis',
                'common_name' => 'Grooved brain coral',
                'description' => 'Named for their brain-like appearance, brain corals are among the longest-living corals and can live over 900 years.',
                'species_type_id' => 7, // Insect (placeholder)
                'conservation_status_id' => 2, // Vulnerable
                'habitat' => 'Coral reefs, moderate depths',
                'diet' => 'Symbiotic algae (photosynthesis)',
                'estimated_population' => 5000000,
            ],

            // Other Marine Creatures
            [
                'name' => 'Saltwater Crocodile',
                'scientific_name' => 'Crocodylus porosus',
                'common_name' => 'Saltwater crocodile, estuarine crocodile',
                'description' => 'The largest living reptile, saltwater crocodiles are found in coastal waters and estuaries throughout Southeast Asia including Indonesia.',
                'species_type_id' => 3, // Reptile
                'conservation_status_id' => 1, // Least Concern
                'habitat' => 'Coastal mangroves, estuaries, rivers',
                'diet' => 'Fish, birds, mammals',
                'estimated_population' => 200000,
            ],
            [
                'name' => 'Sea Horse',
                'scientific_name' => 'Hippocampus kuda',
                'common_name' => 'Yellow seahorse',
                'description' => 'Small marine fish known for prehensile tails and monogamous behavior. Males carry eggs in a brood pouch.',
                'species_type_id' => 4, // Fish
                'conservation_status_id' => 2, // Vulnerable
                'habitat' => 'Seagrass beds, coral reefs',
                'diet' => 'Small crustaceans, plankton',
                'estimated_population' => 8000000,
            ],
            [
                'name' => 'Humphead Wrasse',
                'scientific_name' => 'Cheilinus undulatus',
                'common_name' => 'Napoleon wrasse',
                'description' => 'Large colorful reef fish that can live over 30 years. Called "Napoleon" for the bump on its head.',
                'species_type_id' => 4, // Fish
                'conservation_status_id' => 3, // Endangered
                'habitat' => 'Coral reefs',
                'diet' => 'Mollusks, crustaceans, fish',
                'estimated_population' => 500000,
            ],
        ];

        foreach ($marineAnimals as $animal) {
            Animal::create($animal);
        }
    }
}

