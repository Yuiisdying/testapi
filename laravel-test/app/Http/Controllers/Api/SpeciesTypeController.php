<?php

namespace App\Http\Controllers\Api;

use App\Models\SpeciesType;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SpeciesTypeController extends Controller
{
    /**
     * Get all species types
     */
    public function index(): JsonResponse
    {
        $types = SpeciesType::withCount('animals')->get();
        return response()->json($types);
    }

    /**
     * Get a species type with all its animals
     */
    public function show(SpeciesType $speciesType): JsonResponse
    {
        $speciesType->load('animals.conservationStatus', 'animals.regions');
        return response()->json($speciesType);
    }
}
