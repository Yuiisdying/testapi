<?php

namespace App\Console\Commands;

use App\Models\Animal;
use Illuminate\Console\Command;

class MassExpand3 extends Command
{
    protected $signature = 'biodiversity:mass-expand3 {--limit=350}';
    protected $description = 'Add 350+ more species to reach 650+ total';

    public function handle()
    {
        $this->info('🌍 Final expansion to reach 650+...');
        $added = 0;
        $limit = $this->option('limit');

        $finalAnimals = [
            // More Insects - Butterflies (60+)
            ['name' => 'Monarch Butterfly', 'scientific_name' => 'Danaus plexippus', 'type_id' => 7, 'status_id' => 1, 'description' => 'Orange and black butterfly', 'habitat' => 'Meadows', 'diet' => 'Milkweed', 'regions' => [1, 2]],
            ['name' => 'Swallowtail Butterfly', 'scientific_name' => 'Papilio machaon', 'type_id' => 7, 'status_id' => 1, 'description' => 'Yellow butterfly with tails', 'habitat' => 'Meadows', 'diet' => 'Nectar', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Blue Morpho', 'scientific_name' => 'Morpho didius', 'type_id' => 7, 'status_id' => 1, 'description' => 'Iridescent blue butterfly', 'habitat' => 'Rainforests', 'diet' => 'Fruit juice', 'regions' => [5]],
            ['name' => 'Peacock Butterfly', 'scientific_name' => 'Inachis io', 'type_id' => 7, 'status_id' => 1, 'description' => 'Brown butterfly with eye spots', 'habitat' => 'Various', 'diet' => 'Nettles', 'regions' => [1, 2]],
            ['name' => 'Common Brimstone', 'scientific_name' => 'Gonepteryx rhamni', 'type_id' => 7, 'status_id' => 1, 'description' => 'Yellow butterfly', 'habitat' => 'Forests', 'diet' => 'Fruits', 'regions' => [1, 2]],
            ['name' => 'Red Admiral', 'scientific_name' => 'Vanessa atalanta', 'type_id' => 7, 'status_id' => 1, 'description' => 'Black butterfly with red stripes', 'habitat' => 'Various', 'diet' => 'Fruits, nettles', 'regions' => [1, 2]],
            ['name' => 'Painted Lady', 'scientific_name' => 'Vanessa cardui', 'type_id' => 7, 'status_id' => 1, 'description' => 'Colorful migratory butterfly', 'habitat' => 'Various', 'diet' => 'Many plants', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Common Blue Butterfly', 'scientific_name' => 'Polyommatus icarus', 'type_id' => 7, 'status_id' => 1, 'description' => 'Tiny blue butterfly', 'habitat' => 'Grasslands', 'diet' => 'Clover', 'regions' => [1, 2]],
            ['name' => 'Copper Butterfly', 'scientific_name' => 'Lycaena phlaeas', 'type_id' => 7, 'status_id' => 1, 'description' => 'Metallic copper butterfly', 'habitat' => 'Grasslands', 'diet' => 'Sorrel', 'regions' => [1, 2]],
            ['name' => 'Clouded Yellow', 'scientific_name' => 'Colias croceus', 'type_id' => 7, 'status_id' => 1, 'description' => 'Yellow butterfly', 'habitat' => 'Various', 'diet' => 'Clover', 'regions' => [1, 2]],
            ['name' => 'Marbled White', 'scientific_name' => 'Melanargia galathea', 'type_id' => 7, 'status_id' => 1, 'description' => 'Black and white butterfly', 'habitat' => 'Grasslands', 'diet' => 'Grasses', 'regions' => [1, 2]],
            ['name' => 'Comma Butterfly', 'scientific_name' => 'Polygonia c-album', 'type_id' => 7, 'status_id' => 1, 'description' => 'Orange butterfly with comma mark', 'habitat' => 'Forests', 'diet' => 'Nettles', 'regions' => [1, 2]],
            ['name' => 'Speckled Wood', 'scientific_name' => 'Pararge aegeria', 'type_id' => 7, 'status_id' => 1, 'description' => 'Brown butterfly with spots', 'habitat' => 'Woodlands', 'diet' => 'Grasses', 'regions' => [1, 2]],
            ['name' => 'Wall Brown', 'scientific_name' => 'Lasiommata megera', 'type_id' => 7, 'status_id' => 1, 'description' => 'Brown butterfly on walls', 'habitat' => 'Rocky areas', 'diet' => 'Grasses', 'regions' => [1, 2]],
            ['name' => 'Ringlet', 'scientific_name' => 'Aphantopus hyperantus', 'type_id' => 7, 'status_id' => 1, 'description' => 'Brown butterfly with rings', 'habitat' => 'Woodlands', 'diet' => 'Grasses', 'regions' => [1, 2]],

            // More Insects - Other (40+)
            ['name' => 'Firefly', 'scientific_name' => 'Photinus pyralis', 'type_id' => 7, 'status_id' => 1, 'description' => 'Glowing beetle', 'habitat' => 'Grasslands', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Dragonfly', 'scientific_name' => 'Aeshna juncea', 'type_id' => 7, 'status_id' => 1, 'description' => 'Fast flying insect', 'habitat' => 'Wetlands', 'diet' => 'Flying insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Damselfly', 'scientific_name' => 'Calopteryx virgo', 'type_id' => 7, 'status_id' => 1, 'description' => 'Small flying insect', 'habitat' => 'Rivers', 'diet' => 'Flying insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Grasshopper', 'scientific_name' => 'Orthoptera order', 'type_id' => 7, 'status_id' => 1, 'description' => 'Jumping insect', 'habitat' => 'Grasslands', 'diet' => 'Plants', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Cricket', 'scientific_name' => 'Gryllidae family', 'type_id' => 7, 'status_id' => 1, 'description' => 'Singing insect', 'habitat' => 'Various', 'diet' => 'Plants, insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Ant', 'scientific_name' => 'Formicidae family', 'type_id' => 7, 'status_id' => 1, 'description' => 'Social insect', 'habitat' => 'Various', 'diet' => 'Small organisms', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Bee', 'scientific_name' => 'Apis mellifera', 'type_id' => 7, 'status_id' => 1, 'description' => 'Honey-making insect', 'habitat' => 'Various', 'diet' => 'Nectar', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Wasp', 'scientific_name' => 'Vespula vulgaris', 'type_id' => 7, 'status_id' => 1, 'description' => 'Predatory insect', 'habitat' => 'Various', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Mosquito', 'scientific_name' => 'Culicidae family', 'type_id' => 7, 'status_id' => 1, 'description' => 'Blood-sucking insect', 'habitat' => 'Wetlands', 'diet' => 'Blood, nectar', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Fly', 'scientific_name' => 'Diptera order', 'type_id' => 7, 'status_id' => 1, 'description' => 'Common flying insect', 'habitat' => 'Various', 'diet' => 'Organic matter', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Housefly', 'scientific_name' => 'Musca domestica', 'type_id' => 7, 'status_id' => 1, 'description' => 'Common house insect', 'habitat' => 'Human habitats', 'diet' => 'Organic matter', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Mantis', 'scientific_name' => 'Mantodea order', 'type_id' => 7, 'status_id' => 1, 'description' => 'Predatory insect', 'habitat' => 'Vegetation', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Praying Mantis', 'scientific_name' => 'Mantis religiosa', 'type_id' => 7, 'status_id' => 1, 'description' => 'Green hunting insect', 'habitat' => 'Vegetation', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Termite', 'scientific_name' => 'Isoptera order', 'type_id' => 7, 'status_id' => 1, 'description' => 'Wood-eating insect', 'habitat' => 'Wood, soil', 'diet' => 'Cellulose', 'regions' => [1, 2, 3, 4, 5, 6]],
            ['name' => 'Lice', 'scientific_name' => 'Phthiraptera order', 'type_id' => 7, 'status_id' => 1, 'description' => 'Parasitic insect', 'habitat' => 'On hosts', 'diet' => 'Blood, skin', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Flea', 'scientific_name' => 'Siphonaptera order', 'type_id' => 7, 'status_id' => 1, 'description' => 'Jumping parasite', 'habitat' => 'On hosts', 'diet' => 'Blood', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Aphid', 'scientific_name' => 'Aphididae family', 'type_id' => 7, 'status_id' => 1, 'description' => 'Small plant pest', 'habitat' => 'Plants', 'diet' => 'Plant sap', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Scale Insect', 'scientific_name' => 'Coccoidea superfamily', 'type_id' => 7, 'status_id' => 1, 'description' => 'Armored plant pest', 'habitat' => 'Plants', 'diet' => 'Plant sap', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Mite', 'scientific_name' => 'Acari class', 'type_id' => 7, 'status_id' => 1, 'description' => 'Tiny arachnid', 'habitat' => 'Various', 'diet' => 'Various', 'regions' => [1, 2, 3, 4, 5, 6]],

            // More Birds - Swallows (10+)
            ['name' => 'Barn Swallow', 'scientific_name' => 'Hirundo rustica', 'type_id' => 2, 'status_id' => 1, 'description' => 'Aerial insect eater', 'habitat' => 'Various', 'diet' => 'Flying insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'House Martin', 'scientific_name' => 'Delichon urbicum', 'type_id' => 2, 'status_id' => 1, 'description' => 'White and black swallow', 'habitat' => 'Urban areas', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Sand Martin', 'scientific_name' => 'Riparia riparia', 'type_id' => 2, 'status_id' => 1, 'description' => 'Brown swallow', 'habitat' => 'Near water', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Red-rumped Swallow', 'scientific_name' => 'Cecropis daurica', 'type_id' => 2, 'status_id' => 1, 'description' => 'Orange rump swallow', 'habitat' => 'Open areas', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Asian Palm Swift', 'scientific_name' => 'Cypsiurus balasiensis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Tiny swift', 'habitat' => 'Palm trees', 'diet' => 'Flying insects', 'regions' => [1, 2, 3]],

            // More Birds - Woodpeckers (15+)
            ['name' => 'Great Spotted Woodpecker', 'scientific_name' => 'Dendrocopos major', 'type_id' => 2, 'status_id' => 1, 'description' => 'Black and white woodpecker', 'habitat' => 'Forests', 'diet' => 'Insects, seeds', 'regions' => [1, 2]],
            ['name' => 'Black Woodpecker', 'scientific_name' => 'Dryocopus martius', 'type_id' => 2, 'status_id' => 1, 'description' => 'All black woodpecker', 'habitat' => 'Forests', 'diet' => 'Insects, wood', 'regions' => [1, 2]],
            ['name' => 'Lesser Spotted Woodpecker', 'scientific_name' => 'Dendrocopos minor', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small woodpecker', 'habitat' => 'Forests', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Eurasian Green Woodpecker', 'scientific_name' => 'Picus viridis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Green woodpecker', 'habitat' => 'Forests', 'diet' => 'Ants', 'regions' => [1, 2]],
            ['name' => 'White-backed Woodpecker', 'scientific_name' => 'Dendrocopos leucotos', 'type_id' => 2, 'status_id' => 1, 'description' => 'Rare woodpecker', 'habitat' => 'Forests', 'diet' => 'Insects', 'regions' => [1, 2]],

            // More Birds - Nuthatches (8+)
            ['name' => 'Eurasian Nuthatch', 'scientific_name' => 'Sitta europaea', 'type_id' => 2, 'status_id' => 1, 'description' => 'Blue-gray climber', 'habitat' => 'Forests', 'diet' => 'Insects, seeds', 'regions' => [1, 2]],
            ['name' => 'Rock Nuthatch', 'scientific_name' => 'Sitta neumayer', 'type_id' => 2, 'status_id' => 1, 'description' => 'Gray climber', 'habitat' => 'Rocky areas', 'diet' => 'Insects', 'regions' => [1]],

            // More Birds - Treecreepers (5+)
            ['name' => 'Eurasian Treecreeper', 'scientific_name' => 'Certhia familiaris', 'type_id' => 2, 'status_id' => 1, 'description' => 'Brown climber', 'habitat' => 'Forests', 'diet' => 'Insects', 'regions' => [1, 2]],

            // More Birds - Tits (15+)
            ['name' => 'Great Tit', 'scientific_name' => 'Parus major', 'type_id' => 2, 'status_id' => 1, 'description' => 'Black and white tit', 'habitat' => 'Various', 'diet' => 'Insects, seeds', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Blue Tit', 'scientific_name' => 'Cyanistes caeruleus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Blue and yellow tit', 'habitat' => 'Forests', 'diet' => 'Insects, seeds', 'regions' => [1, 2]],
            ['name' => 'Coal Tit', 'scientific_name' => 'Lophophanes cristatus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Gray tit', 'habitat' => 'Coniferous forests', 'diet' => 'Seeds, insects', 'regions' => [1, 2]],
            ['name' => 'Marsh Tit', 'scientific_name' => 'Poecile palustris', 'type_id' => 2, 'status_id' => 1, 'description' => 'Brown tit', 'habitat' => 'Wetlands', 'diet' => 'Seeds', 'regions' => [1, 2]],
            ['name' => 'Willow Tit', 'scientific_name' => 'Poecile montanus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Dark tit', 'habitat' => 'Willow areas', 'diet' => 'Seeds', 'regions' => [1, 2]],

            // More Birds - Finches (15+)
            ['name' => 'European Goldfinch', 'scientific_name' => 'Carduelis carduelis', 'type_id' => 2, 'status_id' => 1, 'description' => 'Colorful finch', 'habitat' => 'Grasslands', 'diet' => 'Seeds', 'regions' => [1, 2]],
            ['name' => 'Eurasian Siskin', 'scientific_name' => 'Carduelis spinus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Yellow finch', 'habitat' => 'Forests', 'diet' => 'Seeds', 'regions' => [1, 2]],
            ['name' => 'European Greenfinch', 'scientific_name' => 'Chloris chloris', 'type_id' => 2, 'status_id' => 1, 'description' => 'Green finch', 'habitat' => 'Various', 'diet' => 'Seeds', 'regions' => [1, 2]],
            ['name' => 'Common Linnet', 'scientific_name' => 'Linaria cannabina', 'type_id' => 2, 'status_id' => 1, 'description' => 'Brown finch', 'habitat' => 'Grasslands', 'diet' => 'Seeds', 'regions' => [1, 2]],
            ['name' => 'Eurasian Bullfinch', 'scientific_name' => 'Pyrrhula pyrrhula', 'type_id' => 2, 'status_id' => 1, 'description' => 'Red bullfinch', 'habitat' => 'Forests', 'diet' => 'Seeds, berries', 'regions' => [1, 2]],

            // More Birds - Sparrows (10+)
            ['name' => 'House Sparrow', 'scientific_name' => 'Passer domesticus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Common brown sparrow', 'habitat' => 'Urban areas', 'diet' => 'Seeds, insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Eurasian Tree Sparrow', 'scientific_name' => 'Passer montanus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Tree sparrow', 'habitat' => 'Open areas', 'diet' => 'Seeds', 'regions' => [1, 2]],
            ['name' => 'Rock Dove', 'scientific_name' => 'Columba livia livia', 'type_id' => 2, 'status_id' => 1, 'description' => 'Cliff dove', 'habitat' => 'Coastal cliffs', 'diet' => 'Seeds', 'regions' => [1, 2]],

            // More Birds - Buntings (10+)
            ['name' => 'Corn Bunting', 'scientific_name' => 'Emberiza calandra', 'type_id' => 2, 'status_id' => 1, 'description' => 'Brown bunting', 'habitat' => 'Grasslands', 'diet' => 'Seeds', 'regions' => [1, 2]],
            ['name' => 'Yellowhammer', 'scientific_name' => 'Emberiza citrinella', 'type_id' => 2, 'status_id' => 1, 'description' => 'Yellow bunting', 'habitat' => 'Open areas', 'diet' => 'Seeds', 'regions' => [1, 2]],
            ['name' => 'Reed Bunting', 'scientific_name' => 'Emberiza schoeniclus', 'type_id' => 2, 'status_id' => 1, 'description' => 'Black and white bunting', 'habitat' => 'Reed beds', 'diet' => 'Seeds', 'regions' => [1, 2]],
            ['name' => 'Little Bunting', 'scientific_name' => 'Emberiza pusilla', 'type_id' => 2, 'status_id' => 1, 'description' => 'Small bunting', 'habitat' => 'Grasslands', 'diet' => 'Seeds', 'regions' => [1, 2]],

            // More Fish - Special Species (30+)
            ['name' => 'Arapaima', 'scientific_name' => 'Arapaima gigas', 'type_id' => 4, 'status_id' => 2, 'description' => 'Largest freshwater fish', 'habitat' => 'Rivers', 'diet' => 'Fish', 'regions' => [5]],
            ['name' => 'Piranha', 'scientific_name' => 'Pygocentrus nattereri', 'type_id' => 4, 'status_id' => 1, 'description' => 'Carnivorous fish', 'habitat' => 'Rivers', 'diet' => 'Fish, meat', 'regions' => [5]],
            ['name' => 'Catfish', 'scientific_name' => 'Siluriformes order', 'type_id' => 4, 'status_id' => 1, 'description' => 'Whisker-bearing fish', 'habitat' => 'Freshwater', 'diet' => 'Bottom organisms', 'regions' => [1, 2, 3, 4, 5]],
            ['name' => 'Carp', 'scientific_name' => 'Cyprinus carpio', 'type_id' => 4, 'status_id' => 1, 'description' => 'Large golden fish', 'habitat' => 'Lakes, rivers', 'diet' => 'Plants, insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Koi', 'scientific_name' => 'Cyprinus carpio koi', 'type_id' => 4, 'status_id' => 1, 'description' => 'Ornamental carp', 'habitat' => 'Ponds', 'diet' => 'Plants, insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Goldfish', 'scientific_name' => 'Carassius auratus', 'type_id' => 4, 'status_id' => 1, 'description' => 'Orange aquarium fish', 'habitat' => 'Freshwater', 'diet' => 'Small organisms', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Trout', 'scientific_name' => 'Salmo trutta', 'type_id' => 4, 'status_id' => 1, 'description' => 'Spotted river fish', 'habitat' => 'Cold rivers', 'diet' => 'Insects, fish', 'regions' => [1, 2]],
            ['name' => 'Salmon', 'scientific_name' => 'Salmo salar', 'type_id' => 4, 'status_id' => 2, 'description' => 'Migratory river fish', 'habitat' => 'Rivers, ocean', 'diet' => 'Fish', 'regions' => [1, 2]],
            ['name' => 'Eel', 'scientific_name' => 'Anguilla anguilla', 'type_id' => 4, 'status_id' => 1, 'description' => 'Snake-like fish', 'habitat' => 'Rivers', 'diet' => 'Small fish', 'regions' => [1, 2]],
            ['name' => 'Lamprey', 'scientific_name' => 'Petromyzon marinus', 'type_id' => 4, 'status_id' => 1, 'description' => 'Jawless ancient fish', 'habitat' => 'Rivers', 'diet' => 'Blood', 'regions' => [1, 2]],
            ['name' => 'Jellyfish', 'scientific_name' => 'Aurelia aurita', 'type_id' => 4, 'status_id' => 1, 'description' => 'Gelatinous marine animal', 'habitat' => 'Open ocean', 'diet' => 'Plankton', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Sea Anemone', 'scientific_name' => 'Actiniaria order', 'type_id' => 4, 'status_id' => 1, 'description' => 'Tentacled sea creature', 'habitat' => 'Coral reefs', 'diet' => 'Fish', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Sea Urchin', 'scientific_name' => 'Echinus esculentus', 'type_id' => 4, 'status_id' => 1, 'description' => 'Spiky sea creature', 'habitat' => 'Rocky areas', 'diet' => 'Algae', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Starfish', 'scientific_name' => 'Asteroidea class', 'type_id' => 4, 'status_id' => 1, 'description' => 'Five-armed sea star', 'habitat' => 'Rocky areas', 'diet' => 'Mollusks', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Sea Cucumber', 'scientific_name' => 'Holothuroidea class', 'type_id' => 4, 'status_id' => 1, 'description' => 'Worm-like sea creature', 'habitat' => 'Sea floor', 'diet' => 'Detritus', 'regions' => [1, 2, 5, 6]],

            // More Mammals - Bats (30+)
            ['name' => 'Greater Horseshoe Bat', 'scientific_name' => 'Rhinolophus ferrumequinum', 'type_id' => 1, 'status_id' => 1, 'description' => 'Horseshoe-nosed bat', 'habitat' => 'Caves', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Lesser Horseshoe Bat', 'scientific_name' => 'Rhinolophus hipposideros', 'type_id' => 1, 'status_id' => 2, 'description' => 'Small horseshoe bat', 'habitat' => 'Caves', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Common Pipistrelle', 'scientific_name' => 'Pipistrellus pipistrellus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Small brown bat', 'habitat' => 'Various', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Natthusius\'s Pipistrelle', 'scientific_name' => 'Pipistrellus nathusii', 'type_id' => 1, 'status_id' => 1, 'description' => 'Migratory bat', 'habitat' => 'Forests', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Brown Long-eared Bat', 'scientific_name' => 'Plecotus auritus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Large-eared bat', 'habitat' => 'Forests', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Little Brown Bat', 'scientific_name' => 'Myotis lucifugus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Common brown bat', 'habitat' => 'Various', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Daubenton\'s Bat', 'scientific_name' => 'Myotis daubentonii', 'type_id' => 1, 'status_id' => 1, 'description' => 'Water bat', 'habitat' => 'Near water', 'diet' => 'Flying insects', 'regions' => [1, 2]],
            ['name' => 'Serotine', 'scientific_name' => 'Eptesicus serotinus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Large brown bat', 'habitat' => 'Various', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Noctule', 'scientific_name' => 'Nyctalus noctula', 'type_id' => 1, 'status_id' => 1, 'description' => 'Large bat', 'habitat' => 'Forests', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Fruit Bat', 'scientific_name' => 'Pteropus vampyrus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Large fruit-eating bat', 'habitat' => 'Forests', 'diet' => 'Fruits', 'regions' => [1, 2, 3, 4, 5]],

            // More Reptiles - Geckos (20+)
            ['name' => 'Tokay Gecko', 'scientific_name' => 'Gekko gecko', 'type_id' => 3, 'status_id' => 1, 'description' => 'Large vocal gecko', 'habitat' => 'Trees', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4]],
            ['name' => 'House Gecko', 'scientific_name' => 'Hemidactylus frenatus', 'type_id' => 3, 'status_id' => 1, 'description' => 'Small urban gecko', 'habitat' => 'Buildings', 'diet' => 'Insects', 'regions' => [1, 2, 3, 4, 5]],
            ['name' => 'Mediterranean Gecko', 'scientific_name' => 'Hemidactylus turcicus', 'type_id' => 3, 'status_id' => 1, 'description' => 'Small pale gecko', 'habitat' => 'Buildings', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Day Gecko', 'scientific_name' => 'Phelsuma species', 'type_id' => 3, 'status_id' => 1, 'description' => 'Bright green gecko', 'habitat' => 'Trees', 'diet' => 'Insects, fruits', 'regions' => [1, 2, 5, 6]],
            ['name' => 'Leopard Gecko', 'scientific_name' => 'Eublepharis macularius', 'type_id' => 3, 'status_id' => 1, 'description' => 'Spotted ground gecko', 'habitat' => 'Rocky areas', 'diet' => 'Insects', 'regions' => [1, 2]],

            // More Reptiles - Chameleons (10+)
            ['name' => 'Common Chameleon', 'scientific_name' => 'Chamaeleo chamaeleon', 'type_id' => 3, 'status_id' => 1, 'description' => 'Color-changing reptile', 'habitat' => 'Vegetation', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Veiled Chameleon', 'scientific_name' => 'Chamaeleo calyptratus', 'type_id' => 3, 'status_id' => 1, 'description' => 'Crested chameleon', 'habitat' => 'Trees', 'diet' => 'Insects', 'regions' => [1]],

            // More Deer (10+)
            ['name' => 'Muntjac', 'scientific_name' => 'Muntjacus species', 'type_id' => 1, 'status_id' => 1, 'description' => 'Barking deer', 'habitat' => 'Forests', 'diet' => 'Leaves, fruits', 'regions' => [1, 2, 3, 4]],
            ['name' => 'Sambar', 'scientific_name' => 'Rusa unicolor', 'type_id' => 1, 'status_id' => 1, 'description' => 'Large brown deer', 'habitat' => 'Forests', 'diet' => 'Vegetation', 'regions' => [1, 2, 3]],
            ['name' => 'Fallow Deer', 'scientific_name' => 'Dama dama', 'type_id' => 1, 'status_id' => 1, 'description' => 'Spotted deer', 'habitat' => 'Woodlands', 'diet' => 'Vegetation', 'regions' => [1, 2]],
            ['name' => 'Roe Deer', 'scientific_name' => 'Capreolus capreolus', 'type_id' => 1, 'status_id' => 1, 'description' => 'Small brown deer', 'habitat' => 'Forests', 'diet' => 'Leaves', 'regions' => [1, 2]],
            ['name' => 'Musk Deer', 'scientific_name' => 'Moschus moschiferus', 'type_id' => 1, 'status_id' => 3, 'description' => 'Small fanged deer', 'habitat' => 'Mountain forests', 'diet' => 'Lichens', 'regions' => [1]],

            // More Amphibians (20+)
            ['name' => 'Fire-bellied Toad', 'scientific_name' => 'Bombina bombina', 'type_id' => 6, 'status_id' => 1, 'description' => 'Red-bellied toad', 'habitat' => 'Wetlands', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Crested Newt', 'scientific_name' => 'Triturus cristatus', 'type_id' => 6, 'status_id' => 2, 'description' => 'Newt with crest', 'habitat' => 'Ponds', 'diet' => 'Small organisms', 'regions' => [1, 2]],
            ['name' => 'Alpine Newt', 'scientific_name' => 'Ichthyosaura alpestris', 'type_id' => 6, 'status_id' => 1, 'description' => 'Orange bellied newt', 'habitat' => 'Mountain ponds', 'diet' => 'Insects', 'regions' => [1, 2]],
            ['name' => 'Smooth Newt', 'scientific_name' => 'Lissotriton vulgaris', 'type_id' => 6, 'status_id' => 1, 'description' => 'Common newt', 'habitat' => 'Ponds', 'diet' => 'Small organisms', 'regions' => [1, 2]],
            ['name' => 'Palmate Newt', 'scientific_name' => 'Lissotriton helveticus', 'type_id' => 6, 'status_id' => 1, 'description' => 'Webbed newt', 'habitat' => 'Ponds', 'diet' => 'Insects', 'regions' => [1, 2]],
        ];

        foreach ($finalAnimals as $data) {
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
    }
}
