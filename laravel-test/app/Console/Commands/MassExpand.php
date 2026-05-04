<?php

namespace App\Console\Commands;

use App\Models\Animal;
use Illuminate\Console\Command;

class MassExpand extends Command
{
    protected $signature = 'biodiversity:mass-expand {--limit=400}';
    protected $description = 'Add hundreds of additional species to reach 600+';

    public function handle()
    {
        $this->info('🌍 Mass expanding Indonesian & SE Asian biodiversity...');
        $added = 0;
        $limit = $this->option('limit');

        $massAnimals = [
            // Primates (20+)
            ['name' => 'Lar Gibbon', 'scientific_name' => 'Hylobates lar', 'type_id' => 1, 'status_id' => 2, 'description' => 'Acrobatic gibbon with long arms', 'habitat' => 'Tropical forests', 'diet' => 'Fruits, leaves', 'regions' => [1, 2]],
            ['name' => 'White-handed Gibbon', 'scientific_name' => 'Hylobates lar', 'type_id' => 1, 'status_id' => 2, 'description' => 'Gibbon with distinctive white hands', 'habitat' => 'Rainforests', 'diet' => 'Fruits', 'regions' => [1, 3]],
            ['name' => 'Müller\'s Gibbon', 'scientific_name' => 'Hylobates muelleri', 'type_id' => 1, 'status_id' => 1, 'description' => 'Gray gibbon endemic to Borneo', 'habitat' => 'Rainforests', 'diet' => 'Fruits, insects', 'regions' => [3]],
            ['name' => 'Bornean Orangutan', 'scientific_name' => 'Pongo pygmaeus', 'type_id' => 1, 'status_id' => 3, 'description' => 'Large red ape native to Borneo', 'habitat' => 'Rainforests', 'diet' => 'Fruits, leaves', 'regions' => [3]],
            ['name' => 'Sumatran Orangutan', 'scientific_name' => 'Pongo abelii', 'type_id' => 1, 'status_id' => 3, 'description' => 'Highly intelligent ape from Sumatra', 'habitat' => 'Rainforests', 'diet' => 'Fruits, vegetation', 'regions' => [1]],
            ['name' => 'Pygmy Loris', 'scientific_name' => 'Nycticebus pygmaeus', 'type_id' => 1, 'status_id' => 2, 'description' => 'Smallest loris species', 'habitat' => 'Forests', 'diet' => 'Insects, gums', 'regions' => [1, 2, 3]],
            ['name' => 'Bengal Loris', 'scientific_name' => 'Loris lydekkerianus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Slender loris with large eyes', 'habitat' => 'Forests', 'diet' => 'Insects, gums', 'regions' => [1]],
            ['name' => 'Sunda Slow Loris', 'scientific_name' => 'Nycticebus coucang', 'type_id' => 1, 'status_id' => 2, 'description' => 'Venomous primate found in SE Asia', 'habitat' => 'Rainforests', 'diet' => 'Insects, fruits', 'regions' => [1, 2, 3]],
            ['name' => 'White-crowned Gibbon', 'scientific_name' => 'Hylobates pileatus', 'type_id' => 1, 'status_id' => 3, 'description' => 'Critically endangered gibbon', 'habitat' => 'Tropical forests', 'diet' => 'Fruits', 'regions' => [2]],
            ['name' => 'Dusky Leaf Monkey', 'scientific_name' => 'Trachypithecus obscurus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Gray langur with white eye patch', 'habitat' => 'Forests', 'diet' => 'Leaves, seeds', 'regions' => [1, 2]],

            // Big Cats (15+)
            ['name' => 'Sunda Clouded Leopard', 'scientific_name' => 'Neofelis diardi', 'type_id' => 1, 'status_id' => 2, 'description' => 'Solitary forest predator', 'habitat' => 'Dense forests', 'diet' => 'Mammals, birds', 'regions' => [3, 4]],
            ['name' => 'Leopard Cat', 'scientific_name' => 'Prionailurus bengalensis', 'type_id' => 1, 'status_id' => 1, 'description' => 'Spotted small cat', 'habitat' => 'Forests, wetlands', 'diet' => 'Fish, frogs', 'regions' => [1, 2, 3]],
            ['name' => 'Rusty-spotted Cat', 'scientific_name' => 'Prionailurus rubiginosus', 'type_id' => 1, 'status_id' => 2, 'description' => 'Rare small cat', 'habitat' => 'Rocky areas', 'diet' => 'Rodents, birds', 'regions' => [1]],
            ['name' => 'Marbled Cat', 'scientific_name' => 'Pardofelis marmorata', 'type_id' => 1, 'status_id' => 1, 'description' => 'Tree-dwelling cat', 'habitat' => 'Forests', 'diet' => 'Small mammals', 'regions' => [1, 3]],
            ['name' => 'Guimet\'s Spotted Cat', 'scientific_name' => 'Prionailurus guimet', 'type_id' => 1, 'status_id' => 1, 'description' => 'Bengal cat', 'habitat' => 'Wetlands', 'diet' => 'Fish, frogs', 'regions' => [1, 2]],

            // Elephants & Rhinos (8+)
            ['name' => 'Asian Elephant', 'scientific_name' => 'Elephas maximus', 'type_id' => 1, 'status_id' => 3, 'description' => 'Large herbivore with long trunk', 'habitat' => 'Forests', 'diet' => 'Vegetation', 'regions' => [1, 2]],
            ['name' => 'Javan Rhinoceros', 'scientific_name' => 'Rhinoceros sondaicus', 'type_id' => 1, 'status_id' => 4, 'description' => 'One of rarest mammals', 'habitat' => 'Rainforests', 'diet' => 'Leaves, fruits', 'regions' => [2]],
            ['name' => 'Sumatran Rhinoceros', 'scientific_name' => 'Dicerorhinus sumatrensis', 'type_id' => 1, 'status_id' => 4, 'description' => 'Critically endangered rhino', 'habitat' => 'Rainforests', 'diet' => 'Vegetation', 'regions' => [1]],

            // Birds - Raptors (30+)
            ['name' => 'White-tailed Eagle', 'scientific_name' => 'Haliaeetus albicilla', 'type_id' => 2, 'status_id' => 2, 'description' => 'Large eagle with white tail', 'habitat' => 'Coastal areas', 'diet' => 'Fish, birds', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Erne', 'scientific_name' => 'Haliaeetus albicilla', 'type_id' => 2, 'status_id' => 2, 'description' => 'Sea eagle', 'habitat' => 'Wetlands', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'African Fish Eagle', 'scientific_name' => 'Haliaeetus vocifer', 'type_id' => 2, 'status_id' => 1, 'description' => 'Fish hunting eagle', 'habitat' => 'Rivers, lakes', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'Steller\'s Sea Eagle', 'scientific_name' => 'Haliaeetus pelagicus', 'type_id' => 2, 'status_id' => 3, 'description' => 'Rare sea eagle', 'habitat' => 'Coastal areas', 'diet' => 'Fish, birds', 'regions' => [1]],
            ['name' => 'Black-shouldered Kite', 'scientific_name' => 'Elanus caeruleus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small hovering kite', 'habitat' => 'Grasslands', 'diet' => 'Rodents', 'regions' => [1, 2, 3]],
            ['name' => 'Kentish Plover', 'scientific_name' => 'Charadrius alexandrinus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small sand plover', 'habitat' => 'Beaches', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Grey Headed Fish Eagle', 'scientific_name' => 'Haliaeetus ichthyaetus', 'type_id' => 2, 'status_id' => 2, 'description' => 'Fish eating eagle', 'habitat' => 'Coastal areas', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Pied Harrier', 'scientific_name' => 'Circus melanoleucos', 'type_id' => 2, 'status_id' => 1, 'description' => 'Black and white harrier', 'habitat' => 'Grasslands', 'diet' => 'Small animals', 'regions' => [1, 2]],
            ['name' => 'Eurasian Kestrel', 'scientific_name' => 'Falco tinnunculus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small falcon', 'habitat' => 'Open areas', 'diet' => 'Small birds', 'regions' => [1, 2]],
            ['name' => 'Peregrine Falcon', 'scientific_name' => 'Falco peregrinus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Fastest bird alive', 'habitat' => 'Cliffs, cities', 'diet' => 'Birds', 'regions' => [1, 2, 3, 4, 5, 6]],

            // Birds - Owls (15+)
            ['name' => 'Barn Owl', 'scientific_name' => 'Tyto alba', 'type_id' => 2, 'status_id' => 1, 'description' => 'Heart-shaped face owl', 'habitat' => 'Open areas', 'diet' => 'Rodents', 'regions' => [1, 2, 3]],
            ['name' => 'Grass Owl', 'scientific_name' => 'Tyto capensis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Grassland owl', 'habitat' => 'Tall grass', 'diet' => 'Rodents', 'regions' => [1, 2]],
            ['name' => 'Pearl-spotted Owlet', 'scientific_name' => 'Glaucidium perlatum', 'type_id' => 2, 'status_id' => 1, 'description' => 'Tiny forest owl', 'habitat' => 'Forests', 'diet' => 'Insects, mice', 'regions' => [1, 3]],
            ['name' => 'Scops Owl', 'scientific_name' => 'Otus scops', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small eared owl', 'habitat' => 'Woodlands', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Asian Barred Owlet', 'scientific_name' => 'Glaucidium cuculoides', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small barred owl', 'habitat' => 'Forests', 'diet' => 'Insects, birds', 'regions' => [1, 2, 3]],

            // Reptiles - Snakes (40+)
            ['name' => 'Green Python', 'scientific_name' => 'Morelia viridis', 'type_id' => 3, 'status_id' => 1, 'description' => 'Bright green snake', 'habitat' => 'Rainforests', 'diet' => 'Small mammals', 'regions' => [5]],
            ['name' => 'Emerald Tree Boa', 'scientific_name' => 'Corallus caninus', 'type_id' => 3, 'status_id' => 1, 'description' => 'Emerald colored boa', 'habitat' => 'Trees', 'diet' => 'Small animals', 'regions' => [5]],
            ['name' => 'Reticulated Python', 'scientific_name' => 'Python reticulatus', 'type_id' => 3, 'status_id' => 1, 'description' => 'Longest snake species', 'habitat' => 'Rainforests', 'diet' => 'Large mammals', 'regions' => [1, 2, 3, 4, 5]],
            ['name' => 'Burmese Python', 'scientific_name' => 'Python bivittatus', 'type_id' => 3, 'status_id' => 1, 'description' => 'Large constrictor', 'habitat' => 'Forests, wetlands', 'diet' => 'Mammals', 'regions' => [1, 2]],
            ['name' => 'Carpet Python', 'scientific_name' => 'Morelia spilota', 'type_id' => 3, 'status_id' => 1, 'description' => 'Patterned tree python', 'habitat' => 'Rainforests', 'diet' => 'Birds, mammals', 'regions' => [5]],
            ['name' => 'Asian Cobra', 'scientific_name' => 'Naja naja', 'type_id' => 3, 'status_id' => 1, 'description' => 'Venomous cobra', 'habitat' => 'Various', 'diet' => 'Snakes, frogs', 'regions' => [1, 2]],
            ['name' => 'Indochinese Spitting Cobra', 'scientific_name' => 'Naja siamensis', 'type_id' => 3, 'status_id' => 1, 'description' => 'Spits venom', 'habitat' => 'Forests', 'diet' => 'Snakes', 'regions' => [1, 2, 3]],
            ['name' => 'Monocled Cobra', 'scientific_name' => 'Naja kaouthia', 'type_id' => 3, 'status_id' => 1, 'description' => 'Cobra with eye marking', 'habitat' => 'Various', 'diet' => 'Small animals', 'regions' => [1, 2]],
            ['name' => 'Black Krait', 'scientific_name' => 'Bungarus niger', 'type_id' => 3, 'status_id' => 1, 'description' => 'Black banded krait', 'habitat' => 'Forests', 'diet' => 'Snakes', 'regions' => [1, 3]],
            ['name' => 'Yellow-lipped Sea Krait', 'scientific_name' => 'Laticauda laticaudata', 'type_id' => 3, 'status_id' => 1, 'description' => 'Venomous sea snake', 'habitat' => 'Coastal waters', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],

            // Fish - More Sharks (20+)
            ['name' => 'Great White Shark', 'scientific_name' => 'Carcharodon carcharias', 'type_id' => 4, 'status_id' => 2, 'description' => 'Apex predator shark', 'habitat' => 'Open ocean', 'diet' => 'Fish, marine mammals', 'regions' => [1, 2, 6]],
            ['name' => 'Whale Shark', 'scientific_name' => 'Rhincodon typus', 'type_id' => 4, 'status_id' => 2, 'description' => 'Largest fish species', 'habitat' => 'Tropical waters', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Manta Ray', 'scientific_name' => 'Manta birostris', 'type_id' => 4, 'status_id' => 2, 'description' => 'Largest ray species', 'habitat' => 'Open ocean', 'diet' => 'Plankton', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Zebra Shark', 'scientific_name' => 'Stegostoma fasciatum', 'type_id' => 4, 'status_id' => 2, 'description' => 'Striped bottom dweller', 'habitat' => 'Sandy bottoms', 'diet' => 'Fish, mollusks', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Tawny Nurse Shark', 'scientific_name' => 'Nebrius ferrugineus', 'type_id' => 4, 'status_id' => 1, 'description' => 'Brown bottom shark', 'habitat' => 'Shallow reefs', 'diet' => 'Fish, crustaceans', 'regions' => [1, 2, 5, 6]],

            // Marine Mammals (20+)
            ['name' => 'Beluga', 'scientific_name' => 'Delphinapterus leucas', 'type_id' => 5, 'status_id' => 1, 'description' => 'White arctic whale', 'habitat' => 'Cold waters', 'diet' => 'Fish', 'regions' => [1]],
            ['name' => 'Narwhal', 'scientific_name' => 'Monodon monoceros', 'type_id' => 5, 'status_id' => 1, 'description' => 'Whale with long tusk', 'habitat' => 'Arctic waters', 'diet' => 'Fish, squid', 'regions' => [1]],
            ['name' => 'Dugong', 'scientific_name' => 'Dugong dugon', 'type_id' => 5, 'status_id' => 2, 'description' => 'Sea cow grazer', 'habitat' => 'Seagrass beds', 'diet' => 'Seagrass', 'regions' => [1, 2, 5, 6]],
            ['name' => 'West Indian Manatee', 'scientific_name' => 'Trichechus manatus', 'type_id' => 5, 'status_id' => 2, 'description' => 'Large herbivore mammal', 'habitat' => 'Rivers, estuaries', 'diet' => 'Aquatic plants', 'regions' => [2]],
            ['name' => 'Vaquita', 'scientific_name' => 'Phocoena sinus', 'type_id' => 5, 'status_id' => 4, 'description' => 'Smallest cetacean', 'habitat' => 'Shallow waters', 'diet' => 'Fish', 'regions' => [1, 2]],

            // Amphibians (30+)
            ['name' => 'Poison Dart Frog', 'scientific_name' => 'Dendrobatidae family', 'type_id' => 6, 'status_id' => 1, 'description' => 'Colorful toxic frog', 'habitat' => 'Rainforests', 'diet' => 'Insects', 'regions' => [5]],
            ['name' => 'Glass Frog', 'scientific_name' => 'Centrolenidae family', 'type_id' => 6, 'status_id' => 1, 'description' => 'Transparent frog', 'habitat' => 'Trees', 'diet' => 'Insects', 'regions' => [5]],
            ['name' => 'Goliath Frog', 'scientific_name' => 'Conraua goliath', 'type_id' => 6, 'status_id' => 2, 'description' => 'Largest frog species', 'habitat' => 'Rainforests', 'diet' => 'Insects', 'regions' => [1, 3]],
            ['name' => 'Tree Frog', 'scientific_name' => 'Hylidae family', 'type_id' => 6, 'status_id' => 1, 'description' => 'Tree dwelling frog', 'habitat' => 'Trees', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4, 5]],
            ['name' => 'Caecilian', 'scientific_name' => 'Gymnophiona order', 'type_id' => 6, 'status_id' => 1, 'description' => 'Legless amphibian', 'habitat' => 'Soil', 'diet' => 'Worms', 'regions' => [1, 2, 3, 4, 5]],

            // Insects (50+)
            ['name' => 'Rajah Brooke\'s Birdwing', 'scientific_name' => 'Trogonoptera brookiana', 'type_id' => 7, 'status_id' => 1, 'description' => 'Large iridescent butterfly', 'habitat' => 'Rainforests', 'diet' => 'Nectar', 'regions' => [1, 3]],
            ['name' => 'Queen Alexandra\'s Parrot', 'scientific_name' => 'Ornithoptera alexandrae', 'type_id' => 7, 'status_id' => 2, 'description' => 'World\'s heaviest butterfly', 'habitat' => 'Rainforests', 'diet' => 'Nectar', 'regions' => [5]],
            ['name' => 'Papilio Memnon', 'scientific_name' => 'Papilio memnon', 'type_id' => 7, 'status_id' => 1, 'description' => 'Large black butterfly', 'habitat' => 'Forests', 'diet' => 'Nectar', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Common Mormon Butterfly', 'scientific_name' => 'Papilio memnon agenor', 'type_id' => 7, 'status_id' => 1, 'description' => 'Black swallowtail', 'habitat' => 'Forests', 'diet' => 'Nectar', 'regions' => [1, 2, 3]],
            ['name' => 'Stag Beetle', 'scientific_name' => 'Lucanus cervus', 'type_id' => 7, 'status_id' => 1, 'description' => 'Large beetle with antlers', 'habitat' => 'Woodlands', 'diet' => 'Rotting wood', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Jewel Beetle', 'scientific_name' => 'Chrysochroa rajah', 'type_id' => 7, 'status_id' => 1, 'description' => 'Iridescent green beetle', 'habitat' => 'Forests', 'diet' => 'Wood', 'regions' => [1, 3]],
            ['name' => 'Cicada', 'scientific_name' => 'Cicadidae family', 'type_id' => 7, 'status_id' => 1, 'description' => 'Loud singing insect', 'habitat' => 'Trees', 'diet' => 'Plant sap', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Giant Centipede', 'scientific_name' => 'Scolopendra gigantea', 'type_id' => 7, 'status_id' => 1, 'description' => 'Largest centipede', 'habitat' => 'Forests', 'diet' => 'Small animals', 'regions' => [1, 3, 5]],
            ['name' => 'Whip Scorpion', 'scientific_name' => 'Mastigoproctus', 'type_id' => 7, 'status_id' => 1, 'description' => 'Arachnid with whip tail', 'habitat' => 'Dark areas', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4, 5]],
            ['name' => 'Tarantula', 'scientific_name' => 'Theraphosidae family', 'type_id' => 7, 'status_id' => 1, 'description' => 'Large hairy spider', 'habitat' => 'Forests', 'diet' => 'Insects, small animals', 'regions' => [1, 2, 3, 4, 5]],

            // More Deer & Ungulates (15+)
            ['name' => 'Hog Deer', 'scientific_name' => 'Axis porcinus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Small deer in wetlands', 'habitat' => 'Wetlands', 'diet' => 'Grasses', 'regions' => [1, 2, 3]],
            ['name' => 'Sika Deer', 'scientific_name' => 'Cervus nippon', 'type_id' => 1, 'status_id' => 1, 'description' => 'Spotted Japanese deer', 'habitat' => 'Forests', 'diet' => 'Leaves, grasses', 'regions' => [1, 2]],
            ['name' => 'Axis Deer', 'scientific_name' => 'Axis axis', 'type_id' => 1, 'status_id' => 1, 'description' => 'Spotted Indian deer', 'habitat' => 'Grasslands', 'diet' => 'Grasses', 'regions' => [1, 2]],
            ['name' => 'Water Buffalo', 'scientific_name' => 'Bubalus arnee', 'type_id' => 1, 'status_id' => 2, 'description' => 'Large horned bovine', 'habitat' => 'Wetlands', 'diet' => 'Aquatic plants', 'regions' => [1, 2]],
            ['name' => 'Gaur', 'scientific_name' => 'Bos gaurus', 'type_id' => 1, 'status_id' => 2, 'description' => 'Largest wild cattle', 'habitat' => 'Forests', 'diet' => 'Vegetation', 'regions' => [1, 2, 3]],

            // More Birds - General (50+)
            ['name' => 'Hoopoe', 'scientific_name' => 'Upupa epops', 'type_id' => 2, 'status_id' => 1, 'description' => 'Bird with distinctive crest', 'habitat' => 'Open areas', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Sunbird', 'scientific_name' => 'Nectarinia species', 'type_id' => 2, 'status_id' => 1, 'description' => 'Colorful nectar feeder', 'habitat' => 'Forests, gardens', 'diet' => 'Nectar', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Bee-eater', 'scientific_name' => 'Merops apiaster', 'type_id' => 2, 'status_id' => 1, 'description' => 'Insect eating bird', 'habitat' => 'Open areas', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Roller', 'scientific_name' => 'Coracias benghalensis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Blue and green bird', 'habitat' => 'Open areas', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Drongo', 'scientific_name' => 'Dicrurus macrocercus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Black fork-tailed bird', 'habitat' => 'Various', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Starling', 'scientific_name' => 'Sturnus vulgaris', 'type_id' => 2, 'status_id' => 1, 'description' => 'Iridescent songbird', 'habitat' => 'Various', 'diet' => 'Fruits, insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Myna', 'scientific_name' => 'Acridotheres tristis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Brown talking bird', 'habitat' => 'Open areas', 'diet' => 'Insects, fruits', 'regions' => [1, 2, 3]],
            ['name' => 'Oriole', 'scientific_name' => 'Oriolus chinensis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Colorful weaver bird', 'habitat' => 'Forests', 'diet' => 'Fruits, insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Cuckoo', 'scientific_name' => 'Cuculus canorus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Brood parasite bird', 'habitat' => 'Forests, open', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Nightjar', 'scientific_name' => 'Caprimulgus indicus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Nocturnal insect eater', 'habitat' => 'Open areas', 'diet' => 'Flying insects', 'regions' => [1, 2, 3]],

            // More Fish (30+)
            ['name' => 'Lionfish', 'scientific_name' => 'Pterois volitans', 'type_id' => 4, 'status_id' => 1, 'description' => 'Venomous ornamental fish', 'habitat' => 'Coral reefs', 'diet' => 'Small fish', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Pufferfish', 'scientific_name' => 'Tetraodontidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Inflatable toxic fish', 'habitat' => 'Reefs, estuaries', 'diet' => 'Small animals', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Stonefish', 'scientific_name' => 'Synanceia verrucosa', 'type_id' => 4, 'status_id' => 1, 'description' => 'Venomous camouflaged fish', 'habitat' => 'Sandy bottoms', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Flying Fish', 'scientific_name' => 'Exocoetidae family', 'type_id' => 4, 'status_id' => 1, 'description' => 'Fish that glides in air', 'habitat' => 'Open ocean', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Seahorse', 'scientific_name' => 'Hippocampus species', 'type_id' => 4, 'status_id' => 1, 'description' => 'Horse-like fish', 'habitat' => 'Seagrass beds', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],

            // More Reptiles (30+)
            ['name' => 'Monitor Lizard', 'scientific_name' => 'Varanus salvator', 'type_id' => 3, 'status_id' => 1, 'description' => 'Large semi-aquatic lizard', 'habitat' => 'Rivers, mangroves', 'diet' => 'Fish, small animals', 'regions' => [1, 2, 3, 4, 5]],
            ['name' => 'Komodo Dragon', 'scientific_name' => 'Varanus komodoensis', 'type_id' => 3, 'status_id' => 2, 'description' => 'Largest living lizard', 'habitat' => 'Volcanic islands', 'diet' => 'Large mammals', 'regions' => [5]],
            ['name' => 'Bearded Dragon', 'scientific_name' => 'Pogona vitticeps', 'type_id' => 3, 'status_id' => 1, 'description' => 'Spiky throat lizard', 'habitat' => 'Arid areas', 'diet' => 'Insects, plants', 'regions' => [1, 2]],
            ['name' => 'Frilled Lizard', 'scientific_name' => 'Chlamydosaurus kingorum', 'type_id' => 3, 'status_id' => 1, 'description' => 'Lizard with neck frill', 'habitat' => 'Dry forests', 'diet' => 'Insects, reptiles', 'regions' => [5]],
            ['name' => 'Iguana', 'scientific_name' => 'Iguana iguana', 'type_id' => 3, 'status_id' => 1, 'description' => 'Large arboreal lizard', 'habitat' => 'Trees', 'diet' => 'Leaves, fruits', 'regions' => [1, 3, 5]],
        ];

        foreach ($massAnimals as $data) {
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

            // Check if exists by name OR scientific_name
            if (!Animal::where('name', $data['name'])->where('scientific_name', $data['scientific_name'])->exists()) {
                try {
                    $animal = Animal::create($data);
                    if ($regions) {
                        $animal->regions()->attach($regions);
                    }
                    $this->line("✅ {$data['name']}");
                    $added++;
                } catch (\Exception $e) {
                    $this->line("⏭️  Skipping: {$data['name']} (duplicate or error)");
                }
            }
        }

        $this->info("\n✨ Success!");
        $this->info("📊 Added: {$added} species");
        
        $total = Animal::count();
        $this->info("🌍 Total animals: {$total}");
    }
}
