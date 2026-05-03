<?php

namespace App\Http\Controllers\Api;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class AnimalController extends Controller
{
    /**
     * Get all animals with optional filtering and pagination
     */
    public function index(Request $request): JsonResponse
    {
        // Validate all input parameters
        $validated = $request->validate([
            'species_type_id' => 'nullable|integer|min:1',
            'conservation_status_id' => 'nullable|integer|min:1',
            'search' => 'nullable|string|max:100',
            'region_id' => 'nullable|integer|min:1',
            'sea_zone_id' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:500',
            'page' => 'nullable|integer|min:1',
            'paginate' => 'nullable|in:true,false'
        ]);

        $query = Animal::with(['speciesType', 'conservationStatus', 'regions', 'seaZones']);

        // Filter by species type
        if ($request->has('species_type_id') && $validated['species_type_id']) {
            $query->where('species_type_id', $validated['species_type_id']);
        }

        // Filter by conservation status
        if ($request->has('conservation_status_id') && $validated['conservation_status_id']) {
            $query->where('conservation_status_id', $validated['conservation_status_id']);
        }

        // Search by name or scientific name
        if ($request->has('search') && $validated['search']) {
            $search = trim($validated['search']);
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('scientific_name', 'LIKE', "%{$search}%")
                  ->orWhere('common_name', 'LIKE', "%{$search}%");
        }

        // Filter by region
        if ($request->has('region_id') && $validated['region_id']) {
            $query->whereHas('regions', function ($q) use ($validated) {
                $q->where('region_id', $validated['region_id']);
            });
        }

        // Filter by sea zone
        if ($request->has('sea_zone_id') && $validated['sea_zone_id']) {
            $query->whereHas('seaZones', function ($q) use ($validated) {
                $q->where('sea_zone_id', $validated['sea_zone_id']);
            });
        }

        // Handle pagination - reduced default and max
        $perPage = $validated['per_page'] ?? 50; // Reduced from 500 to 50
        $perPage = min($perPage, 500); // Max 500 instead of 1000
        $page = $validated['page'] ?? 1;

        // Check if pagination is requested
        if ($request->has('paginate') && $validated['paginate'] === 'true') {
            $paginated = $query->paginate($perPage, ['*'], 'page', $page);
            return response()->json($paginated);
        }

        // Return all results as array (for backward compatibility)
        $animals = $query->get();

        return response()->json([
            'data' => $animals,
            'total' => count($animals)
        ]);
    }

    /**
     * Get a single animal by ID
     */
    public function show(Animal $animal): JsonResponse
    {
        $animal->load(['speciesType', 'conservationStatus', 'regions', 'seaZones']);
        return response()->json($animal);
    }

    /**
     * Get endangered animals
     */
    public function endangered(): JsonResponse
    {
        $animals = Animal::whereIn('conservation_status_id', [3, 4])
            ->with(['speciesType', 'conservationStatus', 'regions', 'seaZones'])
            ->get();

        return response()->json($animals);
    }

    /**
     * Get animals by region
     */
    public function byRegion($regionId): JsonResponse
    {
        $animals = Animal::whereHas('regions', function ($q) use ($regionId) {
            $q->where('region_id', $regionId);
        })->with(['speciesType', 'conservationStatus', 'regions', 'seaZones'])->get();

        return response()->json($animals);
    }

    /**
     * Get marine animals by sea zone
     */
    public function bySeaZone($seaZoneId): JsonResponse
    {
        $animals = Animal::whereHas('seaZones', function ($q) use ($seaZoneId) {
            $q->where('sea_zone_id', $seaZoneId);
        })->with(['speciesType', 'conservationStatus', 'regions', 'seaZones'])->get();

        return response()->json($animals);
    }
}
