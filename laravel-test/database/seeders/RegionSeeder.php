<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            [
                'name' => 'Sumatra',
                'island_name' => 'Sumatra',
                'description' => 'World\'s second longest island with diverse rainforest ecosystems',
                'latitude' => 0.5,
                'longitude' => 101.4,
            ],
            [
                'name' => 'Java',
                'island_name' => 'Java',
                'description' => 'Most densely populated island with tropical forests',
                'latitude' => -7.0475,
                'longitude' => 110.2305,
            ],
            [
                'name' => 'Borneo',
                'island_name' => 'Borneo',
                'description' => 'Home to unique rainforest species and orangutans',
                'latitude' => 0.0,
                'longitude' => 112.0,
            ],
            [
                'name' => 'Sulawesi',
                'island_name' => 'Sulawesi',
                'description' => 'Unique K-shaped island with endemic species',
                'latitude' => -2.0,
                'longitude' => 121.0,
            ],
            [
                'name' => 'Papua',
                'island_name' => 'Papua',
                'description' => 'World\'s highest biodiversity region with rainforests',
                'latitude' => -4.0,
                'longitude' => 137.0,
            ],
            [
                'name' => 'Bali',
                'island_name' => 'Bali',
                'description' => 'Tropical island with rich marine and terrestrial biodiversity',
                'latitude' => -8.65,
                'longitude' => 115.2167,
            ],
            [
                'name' => 'Lombok',
                'island_name' => 'Lombok',
                'description' => 'Island known for Wallace\'s line biogeographic transition',
                'latitude' => -8.63,
                'longitude' => 116.32,
            ],
            [
                'name' => 'Flores',
                'island_name' => 'Flores',
                'description' => 'Eastern island with tropical forest and unique reptiles',
                'latitude' => -8.75,
                'longitude' => 121.82,
            ],
            [
                'name' => 'Timor',
                'island_name' => 'Timor',
                'description' => 'Eastern island known for endemic reptiles and birds of Wallace-Huxley Line',
                'latitude' => -9.5,
                'longitude' => 124.5,
            ],
            [
                'name' => 'Sulu Islands',
                'island_name' => 'Sulu Islands',
                'description' => 'Archipelago with unique marine species and tropical forests',
                'latitude' => 5.5,
                'longitude' => 120.5,
            ],
            [
                'name' => 'Mentawai Islands',
                'island_name' => 'Mentawai Islands',
                'description' => 'Unique isolated islands off Sumatra\'s coast with endemic primates',
                'latitude' => -1.3,
                'longitude' => 99.2,
            ],
            [
                'name' => 'Riau Islands',
                'island_name' => 'Riau Islands',
                'description' => 'Archipelago between Malaysia-Singapore with marine biodiversity',
                'latitude' => 0.8,
                'longitude' => 103.5,
            ],
            [
                'name' => 'Banda Islands',
                'island_name' => 'Banda Islands',
                'description' => 'Small volcanic islands with endemic species and coral reefs',
                'latitude' => -4.5,
                'longitude' => 129.9,
            ],
            [
                'name' => 'Seram Island',
                'island_name' => 'Seram Island',
                'description' => 'Large central Maluku island with tropical rainforest',
                'latitude' => -3.1,
                'longitude' => 128.5,
            ],
            [
                'name' => 'Halmahera',
                'island_name' => 'Halmahera',
                'description' => 'Northern Maluku island with unique birdlife',
                'latitude' => 1.2,
                'longitude' => 127.5,
            ],
            [
                'name' => 'Morotai',
                'island_name' => 'Morotai',
                'description' => 'Northernmost Indonesian island with tropical forests',
                'latitude' => 2.3,
                'longitude' => 128.3,
            ],
            [
                'name' => 'Ternate & Tidore',
                'island_name' => 'Ternate & Tidore',
                'description' => 'Twin volcanic islands of North Maluku with endemic species',
                'latitude' => 0.8,
                'longitude' => 127.4,
            ],
            [
                'name' => 'Alor Islands',
                'island_name' => 'Alor Islands',
                'description' => 'Eastern Indonesian archipelago with marine and terrestrial biodiversity',
                'latitude' => -8.2,
                'longitude' => 124.6,
            ],
            [
                'name' => 'Komodo',
                'island_name' => 'Komodo',
                'description' => 'Island famous for Komodo dragons and dry tropical forests',
                'latitude' => -8.5,
                'longitude' => 119.5,
            ],
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}
