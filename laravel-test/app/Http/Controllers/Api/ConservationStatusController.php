<?php

namespace App\Http\Controllers\Api;

use App\Models\ConservationStatus;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ConservationStatusController extends Controller
{
    /**
     * Get all conservation statuses
     */
    public function index(): JsonResponse
    {
        $statuses = ConservationStatus::withCount('animals')->orderBy('risk_level')->get();
        return response()->json($statuses);
    }

    /**
     * Get a conservation status with all its animals
     */
    public function show(ConservationStatus $conservationStatus): JsonResponse
    {
        $conservationStatus->load('animals.speciesType', 'animals.regions');
        return response()->json($conservationStatus);
    }
}
