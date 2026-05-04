<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    /**
     * Get all regions
     */
    public function index(): JsonResponse
    {
        $regions = Region::with('animals')->get();
        return response()->json($regions);
    }

    /**
     * Get a single region with all its animals
     */
    public function show(Region $region): JsonResponse
    {
        $region->load('animals.speciesType', 'animals.conservationStatus');
        return response()->json($region);
    }
}
