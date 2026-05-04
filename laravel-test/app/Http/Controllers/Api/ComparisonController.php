<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ComparisonController
{
    public function compare(Request $request)
    {
        $regionIds = $request->input('region_ids', []);
        
        if (!is_array($regionIds) || count($regionIds) !== 2) {
            return response()->json(['error' => 'Please provide exactly 2 region IDs'], 422);
        }

        $regions = Region::with('animals')
            ->whereIn('id', $regionIds)
            ->get();

        if ($regions->count() !== 2) {
            return response()->json(['error' => 'One or both regions not found'], 404);
        }

        $comparison = [];
        foreach ($regions as $region) {
            $animals = $region->animals;
            $comparison[] = [
                'id' => $region->id,
                'name' => $region->name,
                'description' => $region->description,
                'total_species' => $animals->count(),
                'critically_endangered' => $animals->where('conservation_status_id', 4)->count(),
                'endangered' => $animals->where('conservation_status_id', '<=', 3)->count(),
                'avg_population' => (int) ($animals->sum('estimated_population') / max($animals->count(), 1)),
                'declining_species' => $animals->where('population_trend', 'declining')->count(),
                'stable_species' => $animals->where('population_trend', 'stable')->count(),
                'increasing_species' => $animals->where('population_trend', 'increasing')->count(),
                'top_species' => $animals->sortByDesc('estimated_population')->take(5)->map(function($a) {
                    return [
                        'name' => $a->name,
                        'population' => $a->estimated_population
                    ];
                })->values()->toArray(),
            ];
        }

        return response()->json([
            'regions' => $comparison,
            'difference' => [
                'species_diff' => $comparison[0]['total_species'] - $comparison[1]['total_species'],
                'threat_level_diff' => $comparison[0]['endangered'] - $comparison[1]['endangered'],
            ]
        ]);
    }

    public function regionStats(): JsonResponse
    {
        $regions = Region::with('animals')->get()->map(function ($region) {
            return [
                'id' => $region->id,
                'name' => $region->name,
                'species_count' => $region->animals->count(),
                'threat_level' => $region->animals->where('conservation_status_id', '>=', 3)->count(),
            ];
        });

        return response()->json($regions);
    }
}
