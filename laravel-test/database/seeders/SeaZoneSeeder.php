<?php

namespace Database\Seeders;

use App\Models\SeaZone;
use Illuminate\Database\Seeder;

class SeaZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seaZones = [
            // Indonesian Seas
            [
                'name' => 'Java Sea',
                'description' => 'Shallow sea between Java and Sumatra, rich in marine biodiversity',
                'region_type' => 'sea',
                'center_latitude' => -6.5,
                'center_longitude' => 107.0,
                'depth_range' => '0-1200m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Coral reefs, mangrove forests, fishing grounds',
                'area_sq_km' => 340000,
            ],
            [
                'name' => 'Flores Sea',
                'description' => 'Between Flores and Sulawesi, connecting major island groups',
                'region_type' => 'sea',
                'center_latitude' => -7.5,
                'center_longitude' => 121.0,
                'depth_range' => '0-3000m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Deep ocean floor, whale migration routes',
                'area_sq_km' => 120000,
            ],
            [
                'name' => 'Banda Sea',
                'description' => 'Deep sea basin between Banda Islands and Moluccas',
                'region_type' => 'sea',
                'center_latitude' => -4.5,
                'center_longitude' => 129.5,
                'depth_range' => '0-5000m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Deep-sea creatures, hydrothermal vents, rare species',
                'area_sq_km' => 200000,
            ],
            [
                'name' => 'Celebes Sea',
                'description' => 'Between Philippines, Malaysia, and Indonesia',
                'region_type' => 'sea',
                'center_latitude' => 4.5,
                'center_longitude' => 121.0,
                'depth_range' => '0-6000m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Deepest Indonesian waters, unique marine species',
                'area_sq_km' => 350000,
            ],
            [
                'name' => 'Sulawesi Sea',
                'description' => 'Large sea basin around Sulawesi',
                'region_type' => 'sea',
                'center_latitude' => -2.0,
                'center_longitude' => 120.0,
                'depth_range' => '0-4500m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Complex current systems, diverse marine life',
                'area_sq_km' => 280000,
            ],
            [
                'name' => 'Timor Sea',
                'description' => 'Between Indonesia and Australia',
                'region_type' => 'sea',
                'center_latitude' => -10.5,
                'center_longitude' => 126.0,
                'depth_range' => '0-3500m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Upwelling zones, sea turtles, seabirds',
                'area_sq_km' => 420000,
            ],
            [
                'name' => 'Arafura Sea',
                'description' => 'Between Indonesia and Australia',
                'region_type' => 'sea',
                'center_latitude' => -9.0,
                'center_longitude' => 136.0,
                'depth_range' => '0-3200m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Seagrass meadows, sea turtles, dugongs',
                'area_sq_km' => 190000,
            ],

            // Southeast Asian Seas
            [
                'name' => 'Andaman Sea',
                'description' => 'Between Myanmar, Thailand, and Indonesia',
                'region_type' => 'sea',
                'center_latitude' => 6.0,
                'center_longitude' => 98.0,
                'depth_range' => '0-4000m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Coral triangle region, exceptional biodiversity',
                'area_sq_km' => 400000,
            ],
            [
                'name' => 'South China Sea',
                'description' => 'Large sea connecting Vietnam, Thailand, Cambodia, Malaysia',
                'region_type' => 'sea',
                'center_latitude' => 10.5,
                'center_longitude' => 109.0,
                'depth_range' => '0-5500m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Major shipping routes, fisheries, coral reefs',
                'area_sq_km' => 3500000,
            ],
            [
                'name' => 'Sulu Sea',
                'description' => 'Between Philippines and Malaysia',
                'region_type' => 'sea',
                'center_latitude' => 9.0,
                'center_longitude' => 119.0,
                'depth_range' => '0-5500m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Coral triangle hotspot, high endemism',
                'area_sq_km' => 155000,
            ],
            [
                'name' => 'Gulf of Thailand',
                'description' => 'Northern part of South China Sea',
                'region_type' => 'gulf',
                'center_latitude' => 12.5,
                'center_longitude' => 103.0,
                'depth_range' => '0-2500m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Mangrove forests, river deltas, fisheries',
                'area_sq_km' => 350000,
            ],
            [
                'name' => 'Bay of Bengal',
                'description' => 'Large bay connecting India, Myanmar, Bangladesh',
                'region_type' => 'bay',
                'center_latitude' => 16.0,
                'center_longitude' => 88.0,
                'depth_range' => '0-4000m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Cyclone zone, monsoon patterns, sea turtles',
                'area_sq_km' => 2200000,
            ],

            // Malaysian Waters
            [
                'name' => 'Straits of Malacca',
                'description' => 'Narrow strait between Malaysia and Indonesia',
                'region_type' => 'strait',
                'center_latitude' => 2.5,
                'center_longitude' => 101.0,
                'depth_range' => '0-1000m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'One of world\'s busiest shipping lanes, mangroves',
                'area_sq_km' => 65000,
            ],
            [
                'name' => 'Strait of Johor',
                'description' => 'Between Peninsular Malaysia and Singapore',
                'region_type' => 'strait',
                'center_latitude' => 1.3,
                'center_longitude' => 103.7,
                'depth_range' => '0-500m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Urban waters, mangroves, dolphin sightings',
                'area_sq_km' => 3500,
            ],
            [
                'name' => 'South China Sea (Malaysia)',
                'description' => 'Malaysian exclusive economic zone in South China Sea',
                'region_type' => 'sea',
                'center_latitude' => 5.0,
                'center_longitude' => 112.0,
                'depth_range' => '0-5000m',
                'water_type' => 'saltwater',
                'ecosystem_description' => 'Oil platforms, coral reefs, shipping routes',
                'area_sq_km' => 600000,
            ],
        ];

        foreach ($seaZones as $zone) {
            SeaZone::create($zone);
        }
    }
}
