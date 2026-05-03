<?php

namespace App\Http\Controllers\Api;

use App\Models\SeaZone;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SeaZoneController extends Controller
{
    /**
     * Get all sea zones
     */
    public function index(): JsonResponse
    {
        $seaZones = SeaZone::all();
        return response()->json($seaZones);
    }

    /**
     * Get sea zone by type (sea, strait, bay, gulf)
     */
    public function byType($type): JsonResponse
    {
        $seaZones = SeaZone::where('region_type', $type)->get();
        return response()->json($seaZones);
    }

    /**
     * Get a single sea zone with all its animals
     */
    public function show(SeaZone $seaZone): JsonResponse
    {
        $seaZone->load('animals');
        return response()->json($seaZone);
    }

    /**
     * Search sea zones by name
     */
    public function search(Request $request): JsonResponse
    {
        $search = $request->get('q', '');
        
        $seaZones = SeaZone::where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();

        return response()->json($seaZones);
    }

    /**
     * Get Indonesian sea zones only
     */
    public function indonesianSeas(): JsonResponse
    {
        $indonesianSeas = [
            'Java Sea',
            'Flores Sea',
            'Banda Sea',
            'Celebes Sea',
            'Sulawesi Sea',
            'Timor Sea',
            'Arafura Sea',
        ];

        $seaZones = SeaZone::whereIn('name', $indonesianSeas)->get();
        return response()->json($seaZones);
    }

    /**
     * Get SE Asian sea zones
     */
    public function seAsianSeas(): JsonResponse
    {
        $seAsianSeas = [
            'Andaman Sea',
            'South China Sea',
            'Sulu Sea',
            'Gulf of Thailand',
            'Bay of Bengal',
        ];

        $seaZones = SeaZone::whereIn('name', $seAsianSeas)->get();
        return response()->json($seaZones);
    }

    /**
     * Get Malaysian waters
     */
    public function malaysianWaters(): JsonResponse
    {
        $malaysianWaters = [
            'Straits of Malacca',
            'Strait of Johor',
            'South China Sea (Malaysia)',
        ];

        $seaZones = SeaZone::whereIn('name', $malaysianWaters)->get();
        return response()->json($seaZones);
    }

    /**
     * Get critical depth zones (where endangered species live)
     */
    public function criticalZones(): JsonResponse
    {
        $seaZones = SeaZone::whereHas('animals', function ($q) {
            $q->where('conservation_status_id', 4); // Critically Endangered
        })->with('animals')->get();

        return response()->json($seaZones);
    }
}
