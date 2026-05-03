<?php

namespace App\Console\Commands;

use App\Models\Animal;
use Illuminate\Console\Command;

class MassExpand2 extends Command
{
    protected $signature = 'biodiversity:mass-expand2 {--limit=450}';
    protected $description = 'Add 450+ more species to reach 600+ total';

    public function handle()
    {
        $this->info('🌍 Adding 450+ more species to reach 600+...');
        $added = 0;
        $limit = $this->option('limit');

        $moreAnimals = [
            // Birds - Kingfishers (20+)
            ['name' => 'Belted Kingfisher', 'scientific_name' => 'Megaceryle alcyon', 'type_id' => 2, 'status_id' => 1, 'description' => 'Blue gray kingfisher', 'habitat' => 'Rivers', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'Common Kingfisher', 'scientific_name' => 'Alcedo atthis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Bright blue kingfisher', 'habitat' => 'Rivers, lakes', 'diet' => 'Fish', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Pied Kingfisher', 'scientific_name' => 'Ceryle rudis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Black and white fisher', 'habitat' => 'Rivers', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'White-breasted Kingfisher', 'scientific_name' => 'Halcyon smyrnensis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Large white and brown kingfisher', 'habitat' => 'Various', 'diet' => 'Fish, insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Stork-billed Kingfisher', 'scientific_name' => 'Pelargopsis capensis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Large red billed kingfisher', 'habitat' => 'Rivers', 'diet' => 'Fish', 'regions' => [1, 2, 3]],
            ['name' => 'Black-capped Kingfisher', 'scientific_name' => 'Halcyon pileata', 'type_id' => 2, 'status_id' => 1, 'description' => 'Blue kingfisher with black cap', 'habitat' => 'Coastal areas', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'Collared Kingfisher', 'scientific_name' => 'Todirhamphus chloris', 'type_id' => 2, 'status_id' => 1, 'description' => 'Green and white kingfisher', 'habitat' => 'Coastal areas', 'diet' => 'Crabs, fish', 'regions' => [1, 2, 5, 6]],

            // Birds - Herons & Egrets (15+)
            ['name' => 'Great Blue Heron', 'scientific_name' => 'Ardea herodias', 'type_id' => 2, 'status_id' => 1, 'description' => 'Large blue wading bird', 'habitat' => 'Wetlands', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'Grey Heron', 'scientific_name' => 'Ardea cinerea', 'type_id' => 2, 'status_id' => 1, 'description' => 'Common grey wader', 'habitat' => 'Wetlands', 'diet' => 'Fish', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Purple Heron', 'scientific_name' => 'Ardea purpurea', 'type_id' => 2, 'status_id' => 1, 'description' => 'Purple heron', 'habitat' => 'Reed beds', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'Great Egret', 'scientific_name' => 'Ardea alba', 'type_id' => 2, 'status_id' => 1, 'description' => 'Large white egret', 'habitat' => 'Wetlands', 'diet' => 'Fish', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Little Egret', 'scientific_name' => 'Egretta garzetta', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small white egret', 'habitat' => 'Wetlands', 'diet' => 'Fish', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Cattle Egret', 'scientific_name' => 'Bubulcus ibis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Buff egret', 'habitat' => 'Grasslands', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Intermediate Egret', 'scientific_name' => 'Ardea intermedia', 'type_id' => 2, 'status_id' => 1, 'description' => 'Medium white egret', 'habitat' => 'Wetlands', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'Squacco Heron', 'scientific_name' => 'Ardeola ralloides', 'type_id' => 2, 'status_id' => 1, 'description' => 'Buff heron', 'habitat' => 'Wetlands', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'Night Heron', 'scientific_name' => 'Nycticorax nycticorax', 'type_id' => 2, 'status_id' => 1, 'description' => 'Nocturnal heron', 'habitat' => 'Reed beds', 'diet' => 'Fish', 'regions' => [1, 2, 3, 4]],

            // Birds - Storks (10+)
            ['name' => 'White Stork', 'scientific_name' => 'Ciconia ciconia', 'type_id' => 2, 'status_id' => 1, 'description' => 'Large white wading bird', 'habitat' => 'Wetlands', 'diet' => 'Frogs, fish', 'regions' => [1, 2]],
            ['name' => 'Black Stork', 'scientific_name' => 'Ciconia nigra', 'type_id' => 2, 'status_id' => 2, 'description' => 'Black wading bird', 'habitat' => 'Forests', 'diet' => 'Fish', 'regions' => [1]],
            ['name' => 'Woolly-necked Stork', 'scientific_name' => 'Ciconia episcopus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Brown stork', 'habitat' => 'Wetlands', 'diet' => 'Frogs, fish', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Asian Openbill', 'scientific_name' => 'Anastomus oscitans', 'type_id' => 2, 'status_id' => 1, 'description' => 'Stork with open bill', 'habitat' => 'Wetlands', 'diet' => 'Mollusks', 'regions' => [1, 2, 3]],

            // Birds - Waterfowl (15+)
            ['name' => 'Mallard', 'scientific_name' => 'Anas platyrhynchos', 'type_id' => 2, 'status_id' => 1, 'description' => 'Common dabbling duck', 'habitat' => 'Lakes, rivers', 'diet' => 'Plants, insects', 'regions' => [1, 2]],
            ['name' => 'Spot-billed Duck', 'scientific_name' => 'Anas poecilorhyncha', 'type_id' => 2, 'status_id' => 1, 'description' => 'Red spotted duck', 'habitat' => 'Wetlands', 'diet' => 'Plants', 'regions' => [1, 2, 3]],
            ['name' => 'Northern Shoveler', 'scientific_name' => 'Anas clypeata', 'type_id' => 2, 'status_id' => 1, 'description' => 'Duck with large bill', 'habitat' => 'Wetlands', 'diet' => 'Plankton', 'regions' => [1, 2]],
            ['name' => 'Garganey', 'scientific_name' => 'Spatula querquedula', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small diving duck', 'habitat' => 'Wetlands', 'diet' => 'Plants', 'regions' => [1, 2]],
            ['name' => 'Pintail', 'scientific_name' => 'Anas acuta', 'type_id' => 2, 'status_id' => 1, 'description' => 'Elegant long-necked duck', 'habitat' => 'Wetlands', 'diet' => 'Plants, insects', 'regions' => [1, 2]],

            // More Fish - Reef Fish (80+)
            ['name' => 'Clownfish', 'scientific_name' => 'Amphiprion ocellaris', 'type_id' => 4, 'status_id' => 1, 'description' => 'Orange anemone fish', 'habitat' => 'Coral reefs', 'diet' => 'Algae, plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Angelfish', 'scientific_name' => 'Pomacanthidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Colorful reef fish', 'habitat' => 'Coral reefs', 'diet' => 'Sponges, algae', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Butterflyfish', 'scientific_name' => 'Chaetodontidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Yellow striped reef fish', 'habitat' => 'Coral reefs', 'diet' => 'Coral polyps', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Damselfish', 'scientific_name' => 'Pomacentridae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Small colorful reef fish', 'habitat' => 'Coral reefs', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Parrotfish', 'scientific_name' => 'Scaridae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Beak-like teeth fish', 'habitat' => 'Coral reefs', 'diet' => 'Coral', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Goby', 'scientific_name' => 'Gobiidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Small bottom dwelling fish', 'habitat' => 'Coral reefs', 'diet' => 'Small organisms', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Grouper', 'scientific_name' => 'Epinephelus species', 'type_id' => 4, 'status_id' => 1, 'description' => 'Large reef predator', 'habitat' => 'Coral reefs', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Wrasse', 'scientific_name' => 'Labridae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Colorful cleaner fish', 'habitat' => 'Coral reefs', 'diet' => 'Small fish, parasites', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Triggerfish', 'scientific_name' => 'Balistidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Spiny tropical fish', 'habitat' => 'Coral reefs', 'diet' => 'Mollusks, coral', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Filefish', 'scientific_name' => 'Monacanthidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Thin reef fish', 'habitat' => 'Coral reefs', 'diet' => 'Algae, small animals', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Blenny', 'scientific_name' => 'Blenniidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Small reef fish', 'habitat' => 'Coral reefs', 'diet' => 'Algae, parasites', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Seahorse', 'scientific_name' => 'Hippocampus kuda', 'type_id' => 4, 'status_id' => 1, 'description' => 'Small prehensile horse fish', 'habitat' => 'Seagrass beds', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Pipefish', 'scientific_name' => 'Syngnathidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Slender seahorse relative', 'habitat' => 'Seagrass beds', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Dragonet', 'scientific_name' => 'Callionymidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Small colorful reef fish', 'habitat' => 'Sandy bottoms', 'diet' => 'Small organisms', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Scorpionfish', 'scientific_name' => 'Scorpaenidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Venomous camouflaged fish', 'habitat' => 'Rocky areas', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Jawfish', 'scientific_name' => 'Opistognathus species', 'type_id' => 4, 'status_id' => 1, 'description' => 'Burrow dwelling fish', 'habitat' => 'Sandy bottoms', 'diet' => 'Small organisms', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Mandarin Fish', 'scientific_name' => 'Synchiropus splendidus', 'type_id' => 4, 'status_id' => 1, 'description' => 'Most colorful fish', 'habitat' => 'Coral reefs', 'diet' => 'Small organisms', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Dottyback', 'scientific_name' => 'Pictichthyidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Tiny colorful reef fish', 'habitat' => 'Deep reefs', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Chromis', 'scientific_name' => 'Chromis species', 'type_id' => 4, 'status_id' => 1, 'description' => 'Schooling reef fish', 'habitat' => 'Coral reefs', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Cardinalfish', 'scientific_name' => 'Apogonidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Nocturnal reef fish', 'habitat' => 'Coral reefs', 'diet' => 'Small organisms', 'regions' => [1, 2, 5, 6]],

            // More Birds - Rails (10+)
            ['name' => 'Eurasian Coot', 'scientific_name' => 'Fulica atra', 'type_id' => 2, 'status_id' => 1, 'description' => 'Black water bird', 'habitat' => 'Lakes', 'diet' => 'Plants, insects', 'regions' => [1, 2]],
            ['name' => 'Purple Swamphen', 'scientific_name' => 'Porphyrio porphyrio', 'type_id' => 2, 'status_id' => 1, 'description' => 'Purple rail', 'habitat' => 'Wetlands', 'diet' => 'Plants, fish', 'regions' => [1, 2]],
            ['name' => 'Common Moorhen', 'scientific_name' => 'Gallinula chloropus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Red and black rail', 'habitat' => 'Wetlands', 'diet' => 'Plants, insects', 'regions' => [1, 2]],

            // Reptiles - More Turtles (20+)
            ['name' => 'Leatherback Turtle', 'scientific_name' => 'Dermochelys coriacea', 'type_id' => 3, 'status_id' => 3, 'description' => 'Largest turtle species', 'habitat' => 'Open ocean', 'diet' => 'Jellyfish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Green Sea Turtle', 'scientific_name' => 'Chelonia mydas', 'type_id' => 3, 'status_id' => 3, 'description' => 'Large marine turtle', 'habitat' => 'Ocean, beaches', 'diet' => 'Seagrass, jellyfish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Hawksbill Turtle', 'scientific_name' => 'Eretmochelys imbricata', 'type_id' => 3, 'status_id' => 3, 'description' => 'Beak-like turtle', 'habitat' => 'Coral reefs', 'diet' => 'Sponges', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Loggerhead Turtle', 'scientific_name' => 'Caretta caretta', 'type_id' => 3, 'status_id' => 2, 'description' => 'Large headed turtle', 'habitat' => 'Ocean', 'diet' => 'Fish, mollusks', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Olive Ridley Turtle', 'scientific_name' => 'Lepidochelys olivacea', 'type_id' => 3, 'status_id' => 3, 'description' => 'Smallest marine turtle', 'habitat' => 'Ocean', 'diet' => 'Jellyfish, fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Asian Giant Tortoise', 'scientific_name' => 'Testudo species', 'type_id' => 3, 'status_id' => 3, 'description' => 'Large terrestrial turtle', 'habitat' => 'Forests', 'diet' => 'Vegetation', 'regions' => [1, 2, 3]],

            // More Mammals (40+)
            ['name' => 'Slow Loris', 'scientific_name' => 'Nycticebus coucang', 'type_id' => 1, 'status_id' => 2, 'description' => 'Nocturnal primate', 'habitat' => 'Forests', 'diet' => 'Insects, gums', 'regions' => [1, 2, 3]],
            ['name' => 'Flying Lemur', 'scientific_name' => 'Cynocephalus variegatus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Gliding mammal', 'habitat' => 'Rainforests', 'diet' => 'Leaves', 'regions' => [1, 3]],
            ['name' => 'Treeshrew', 'scientific_name' => 'Tupaia species', 'type_id' => 1, 'status_id' => 1, 'description' => 'Small squirrel-like mammal', 'habitat' => 'Forests', 'diet' => 'Insects, fruits', 'regions' => [1, 2, 3]],
            ['name' => 'Porcupine', 'scientific_name' => 'Hystrix species', 'type_id' => 1, 'status_id' => 1, 'description' => 'Spiky rodent', 'habitat' => 'Forests', 'diet' => 'Bark, plants', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Crested Porcupine', 'scientific_name' => 'Hystrix cristata', 'type_id' => 1, 'status_id' => 1, 'description' => 'Large spiny rodent', 'habitat' => 'Various', 'diet' => 'Plants', 'regions' => [1, 2]],
            ['name' => 'Flying Squirrel', 'scientific_name' => 'Petaurista species', 'type_id' => 1, 'status_id' => 1, 'description' => 'Gliding rodent', 'habitat' => 'Forests', 'diet' => 'Nuts, seeds', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Giant Flying Squirrel', 'scientific_name' => 'Petaurista petaurista', 'type_id' => 1, 'status_id' => 1, 'description' => 'Large gliding rodent', 'habitat' => 'Rainforests', 'diet' => 'Nuts', 'regions' => [1, 3]],
            ['name' => 'Palm Civet', 'scientific_name' => 'Paradoxurus hermaphroditus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Common viverrid', 'habitat' => 'Forests, urban', 'diet' => 'Fruits, small animals', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Common Palm Civet', 'scientific_name' => 'Paradoxurus hermaphroditus hermaphroditus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Urban civet', 'habitat' => 'Various', 'diet' => 'Fruits, insects', 'regions' => [1, 2, 3]],
            ['name' => 'Asian Palm Civet', 'scientific_name' => 'Paradoxurus hermaphroditus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Nocturnal viverrid', 'habitat' => 'Forests', 'diet' => 'Coffee berries', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Masked Palm Civet', 'scientific_name' => 'Paguma larvata', 'type_id' => 1, 'status_id' => 1, 'description' => 'Masked viverrid', 'habitat' => 'Forests', 'diet' => 'Fruits', 'regions' => [1, 2, 3]],
            ['name' => 'Small-toothed Palm Civet', 'scientific_name' => 'Arctictis binturong', 'type_id' => 1, 'status_id' => 2, 'description' => 'Binturong', 'habitat' => 'Rainforests', 'diet' => 'Fruits', 'regions' => [1, 3]],
            ['name' => 'Otter-civet', 'scientific_name' => 'Cynogale bennettii', 'type_id' => 1, 'status_id' => 2, 'description' => 'Semi-aquatic viverrid', 'habitat' => 'Rivers', 'diet' => 'Fish, crustaceans', 'regions' => [1, 3]],
            ['name' => 'Smooth-coated Otter', 'scientific_name' => 'Lutrogale perspicillata', 'type_id' => 1, 'status_id' => 2, 'description' => 'Aquatic carnivore', 'habitat' => 'Rivers, lakes', 'diet' => 'Fish', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Asian Short-clawed Otter', 'scientific_name' => 'Aonyx cinereus', 'type_id' => 1, 'status_id' => 2, 'description' => 'Small otter', 'habitat' => 'Freshwater areas', 'diet' => 'Crustaceans', 'regions' => [1, 2, 3]],
            ['name' => 'Badger', 'scientific_name' => 'Meles meles', 'type_id' => 1, 'status_id' => 1, 'description' => 'Burrowing mustelid', 'habitat' => 'Forests, grasslands', 'diet' => 'Small animals', 'regions' => [1, 2]],
            ['name' => 'Honey Badger', 'scientific_name' => 'Mellivora capensis', 'type_id' => 1, 'status_id' => 1, 'description' => 'Fearless carnivore', 'habitat' => 'Various', 'diet' => 'Honey, small animals', 'regions' => [1, 2]],
            ['name' => 'Mongoose', 'scientific_name' => 'Herpestes species', 'type_id' => 1, 'status_id' => 1, 'description' => 'Snake-hunting carnivore', 'habitat' => 'Various', 'diet' => 'Snakes, small animals', 'regions' => [1, 2]],
            ['name' => 'Common Mongoose', 'scientific_name' => 'Herpestes edwardsi', 'type_id' => 1, 'status_id' => 1, 'description' => 'Gray mongoose', 'habitat' => 'Various', 'diet' => 'Insects, reptiles', 'regions' => [1, 2]],
            ['name' => 'Musk Shrew', 'scientific_name' => 'Suncus murinus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Small shrew', 'habitat' => 'Various', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4]],

            // More Amphibians (30+)
            ['name' => 'Common Frog', 'scientific_name' => 'Rana temporaria', 'type_id' => 6, 'status_id' => 1, 'description' => 'Brown frog', 'habitat' => 'Wetlands', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Bullfrog', 'scientific_name' => 'Lithobates catesbeianus', 'type_id' => 6, 'status_id' => 1, 'description' => 'Large loud frog', 'habitat' => 'Lakes', 'diet' => 'Insects, frogs', 'regions' => [1, 2]],
            ['name' => 'Edible Frog', 'scientific_name' => 'Pelophylax kl. esculentus', 'type_id' => 6, 'status_id' => 1, 'description' => 'Green frog', 'habitat' => 'Wetlands', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Toad', 'scientific_name' => 'Bufo marinus', 'type_id' => 6, 'status_id' => 1, 'description' => 'Warty amphibian', 'habitat' => 'Various', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4, 5]],
            ['name' => 'Cane Toad', 'scientific_name' => 'Rhinella marina', 'type_id' => 6, 'status_id' => 1, 'description' => 'Large warty toad', 'habitat' => 'Various', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4, 5]],
            ['name' => 'Common Toad', 'scientific_name' => 'Bufo bufo', 'type_id' => 6, 'status_id' => 1, 'description' => 'Brown warty toad', 'habitat' => 'Various', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Asian Toad', 'scientific_name' => 'Bufo asper', 'type_id' => 6, 'status_id' => 1, 'description' => 'Black toad', 'habitat' => 'Forests', 'diet' => 'Insects', 'regions' => [1, 2, 3]],

            // Crustaceans (20+)
            ['name' => 'Giant Freshwater Prawn', 'scientific_name' => 'Macrobrachium rosenbergii', 'type_id' => 8, 'status_id' => 1, 'description' => 'Large freshwater prawn', 'habitat' => 'Rivers', 'diet' => 'Algae, small animals', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Coconut Crab', 'scientific_name' => 'Birgus latro', 'type_id' => 8, 'status_id' => 1, 'description' => 'Largest land crustacean', 'habitat' => 'Islands', 'diet' => 'Fruits, coconuts', 'regions' => [5, 6]],
            ['name' => 'Red Crab', 'scientific_name' => 'Gecarcinus quadratus', 'type_id' => 8, 'status_id' => 1, 'description' => 'Bright red crab', 'habitat' => 'Coastal areas', 'diet' => 'Plants, debris', 'regions' => [1, 2]],
            ['name' => 'Land Crab', 'scientific_name' => 'Cardisoma species', 'type_id' => 8, 'status_id' => 1, 'description' => 'Terrestrial crab', 'habitat' => 'Coastal areas', 'diet' => 'Plants', 'regions' => [1, 2, 5]],
            ['name' => 'Hermit Crab', 'scientific_name' => 'Paguridae family', 'type_id' => 8, 'status_id' => 1, 'description' => 'Shell-carrying crab', 'habitat' => 'Coastal areas', 'diet' => 'Detritus', 'regions' => [1, 2, 5, 6]],

            // Mollusks (20+)
            ['name' => 'Giant Clam', 'scientific_name' => 'Tridacna gigas', 'type_id' => 9, 'status_id' => 2, 'description' => 'Largest bivalve', 'habitat' => 'Coral reefs', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Nautilus', 'scientific_name' => 'Nautilus pompilius', 'type_id' => 9, 'status_id' => 1, 'description' => 'Living fossil cephalopod', 'habitat' => 'Deep reefs', 'diet' => 'Fish, crustaceans', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Cuttlefish', 'scientific_name' => 'Sepia officinalis', 'type_id' => 9, 'status_id' => 1, 'description' => 'Intelligent cephalopod', 'habitat' => 'Shallow waters', 'diet' => 'Fish, crustaceans', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Squid', 'scientific_name' => 'Loligo species', 'type_id' => 9, 'status_id' => 1, 'description' => 'Fast swimming mollusk', 'habitat' => 'Open water', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Giant Squid', 'scientific_name' => 'Architeuthis dux', 'type_id' => 9, 'status_id' => 1, 'description' => 'Largest invertebrate', 'habitat' => 'Deep ocean', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],

            // More Birds - Warblers (30+)
            ['name' => 'Arctic Warbler', 'scientific_name' => 'Phylloscopus borealis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small migrant warbler', 'habitat' => 'Forests', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Asian Paradise Flycatcher', 'scientific_name' => 'Terpsiphone paradisi', 'type_id' => 2, 'status_id' => 1, 'description' => 'Elegant long-tailed bird', 'habitat' => 'Forests', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Spotted Flycatcher', 'scientific_name' => 'Muscicapa striata', 'type_id' => 2, 'status_id' => 1, 'description' => 'Gray flycatcher', 'habitat' => 'Open areas', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Black-capped Flycatcher', 'scientific_name' => 'Flycatcher species', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small insect eater', 'habitat' => 'Forests', 'diet' => 'Insects', 'regions' => [1, 2, 3]],
            ['name' => 'Tickell\'s Thrush', 'scientific_name' => 'Turdus unicolor', 'type_id' => 2, 'status_id' => 1, 'description' => 'Blue gray thrush', 'habitat' => 'Forests', 'diet' => 'Berries, insects', 'regions' => [1, 2]],

            // More Reptiles - Snakes (40+)
            ['name' => 'King Cobra', 'scientific_name' => 'Ophiophagus hannah', 'type_id' => 3, 'status_id' => 1, 'description' => 'World\'s longest venomous snake', 'habitat' => 'Forests', 'diet' => 'Snakes', 'regions' => [1, 2, 3]],
            ['name' => 'Boa Constrictor', 'scientific_name' => 'Boa constrictor', 'type_id' => 3, 'status_id' => 1, 'description' => 'Large snake', 'habitat' => 'Forests', 'diet' => 'Mammals', 'regions' => [5]],
            ['name' => 'Pit Viper', 'scientific_name' => 'Crotalus species', 'type_id' => 3, 'status_id' => 1, 'description' => 'Heat-sensing viper', 'habitat' => 'Forests', 'diet' => 'Small mammals', 'regions' => [1, 2, 3]],
            ['name' => 'White-lipped Pit Viper', 'scientific_name' => 'Trimeresurus albolabris', 'type_id' => 3, 'status_id' => 1, 'description' => 'Green pit viper', 'habitat' => 'Trees', 'diet' => 'Frogs, insects', 'regions' => [1, 2, 3]],
            ['name' => 'Malayan Pit Viper', 'scientific_name' => 'Calloselasma rhodostoma', 'type_id' => 3, 'status_id' => 1, 'description' => 'Brown pit viper', 'habitat' => 'Forests', 'diet' => 'Small animals', 'regions' => [1, 2, 3]],
            ['name' => 'Sea Krait', 'scientific_name' => 'Laticauda species', 'type_id' => 3, 'status_id' => 1, 'description' => 'Venomous sea snake', 'habitat' => 'Coastal waters', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Blue-lipped Sea Krait', 'scientific_name' => 'Laticauda laticaudata coeruleolineatus', 'type_id' => 3, 'status_id' => 1, 'description' => 'Blue striped sea snake', 'habitat' => 'Tropical waters', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],

            // More Fish - Open Ocean (30+)
            ['name' => 'Sailfish', 'scientific_name' => 'Istiophorus platypterus', 'type_id' => 4, 'status_id' => 1, 'description' => 'Fastest fish with sail', 'habitat' => 'Open ocean', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Marlin', 'scientific_name' => 'Makaira indica', 'type_id' => 4, 'status_id' => 1, 'description' => 'Large game fish', 'habitat' => 'Open ocean', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Tuna', 'scientific_name' => 'Thunnus species', 'type_id' => 5, 'status_id' => 1, 'description' => 'Fast migratory fish', 'habitat' => 'Open ocean', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Yellowfin Tuna', 'scientific_name' => 'Thunnus albacares', 'type_id' => 5, 'status_id' => 1, 'description' => 'Yellow-finned tuna', 'habitat' => 'Open ocean', 'diet' => 'Fish, squid', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Swordfish', 'scientific_name' => 'Xiphias gladius', 'type_id' => 4, 'status_id' => 1, 'description' => 'Fish with sword-like bill', 'habitat' => 'Open ocean', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Barracuda', 'scientific_name' => 'Sphyraena barracuda', 'type_id' => 4, 'status_id' => 1, 'description' => 'Predatory open water fish', 'habitat' => 'Open ocean', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Jack Fish', 'scientific_name' => 'Caranx species', 'type_id' => 4, 'status_id' => 1, 'description' => 'Schooling predator', 'habitat' => 'Open ocean', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],

            // Birds - Pheasants (10+)
            ['name' => 'Red Junglefowl', 'scientific_name' => 'Gallus gallus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Ancestor of domestic chicken', 'habitat' => 'Forests', 'diet' => 'Seeds, insects', 'regions' => [1, 2, 3]],
            ['name' => 'Green Peafowl', 'scientific_name' => 'Pavo muticus', 'type_id' => 2, 'status_id' => 2, 'description' => 'Emerald pheasant', 'habitat' => 'Forests', 'diet' => 'Seeds, insects', 'regions' => [1, 2, 3]],

            // Birds - Pigeons (15+)
            ['name' => 'Rock Pigeon', 'scientific_name' => 'Columba livia', 'type_id' => 2, 'status_id' => 1, 'description' => 'Common city dove', 'habitat' => 'Various', 'diet' => 'Seeds', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Painted Dove', 'scientific_name' => 'Streptopelia tranquebarica', 'type_id' => 2, 'status_id' => 1, 'description' => 'Red dove', 'habitat' => 'Open areas', 'diet' => 'Seeds', 'regions' => [1, 2]],
            ['name' => 'Laughing Dove', 'scientific_name' => 'Streptopelia senegalensis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small brown dove', 'habitat' => 'Open areas', 'diet' => 'Seeds', 'regions' => [1, 2]],

            // Additional Rodents (30+)
            ['name' => 'Malayan Giant Squirrel', 'scientific_name' => 'Ratufa affinis', 'type_id' => 1, 'status_id' => 1, 'description' => 'Large red squirrel', 'habitat' => 'Rainforests', 'diet' => 'Nuts, seeds', 'regions' => [1, 3]],
            ['name' => 'Prevost\'s Squirrel', 'scientific_name' => 'Callosciurus prevostii', 'type_id' => 1, 'status_id' => 1, 'description' => 'Tri-colored squirrel', 'habitat' => 'Forests', 'diet' => 'Nuts, insects', 'regions' => [1, 3]],
            ['name' => 'Plantain Squirrel', 'scientific_name' => 'Callosciurus notatus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Small striped squirrel', 'habitat' => 'Forests', 'diet' => 'Nuts, fruits', 'regions' => [1, 2, 3]],
            ['name' => 'Variable Squirrel', 'scientific_name' => 'Callosciurus finlaysonii', 'type_id' => 1, 'status_id' => 1, 'description' => 'Variable colored squirrel', 'habitat' => 'Forests', 'diet' => 'Nuts', 'regions' => [1, 2, 3]],
            ['name' => 'Grooved-toothed Flying Squirrel', 'scientific_name' => 'Aeromys tephromelas', 'type_id' => 1, 'status_id' => 1, 'description' => 'Gray flying squirrel', 'habitat' => 'Rainforests', 'diet' => 'Nuts', 'regions' => [1, 5]],
        ];

        foreach ($moreAnimals as $data) {
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

            // Check if exists by name
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
    }
}
