<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnimalController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\SpeciesTypeController;
use App\Http\Controllers\Api\ConservationStatusController;
use App\Http\Controllers\Api\SeaZoneController;
use App\Http\Controllers\Api\ComparisonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Biodiversity Map API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('biodiversity')->group(function () {
    // Animals routes
    Route::get('/animals', [AnimalController::class, 'index']);
    Route::get('/animals/endangered', [AnimalController::class, 'endangered']);
    Route::get('/animals/region/{region}', [AnimalController::class, 'byRegion']);
    Route::get('/animals/sea-zone/{seaZone}', [AnimalController::class, 'bySeaZone']);
    Route::get('/animals/{animal}', [AnimalController::class, 'show']);

    // Regions routes
    Route::get('/regions', [RegionController::class, 'index']);
    Route::get('/regions/{region}', [RegionController::class, 'show']);

    // Sea zones routes
    Route::get('/sea-zones', [SeaZoneController::class, 'index']);
    Route::get('/sea-zones/indonesian', [SeaZoneController::class, 'indonesianSeas']);
    Route::get('/sea-zones/southeast-asian', [SeaZoneController::class, 'seAsianSeas']);
    Route::get('/sea-zones/malaysian', [SeaZoneController::class, 'malaysianWaters']);
    Route::get('/sea-zones/critical', [SeaZoneController::class, 'criticalZones']);
    Route::get('/sea-zones/type/{type}', [SeaZoneController::class, 'byType']);
    Route::get('/sea-zones/search', [SeaZoneController::class, 'search']);
    Route::get('/sea-zones/{seaZone}', [SeaZoneController::class, 'show']);

    // Species types routes
    Route::get('/species-types', [SpeciesTypeController::class, 'index']);
    Route::get('/species-types/{speciesType}', [SpeciesTypeController::class, 'show']);

    // Conservation status routes
    Route::get('/conservation-statuses', [ConservationStatusController::class, 'index']);
    Route::get('/conservation-statuses/{conservationStatus}', [ConservationStatusController::class, 'show']);

    // Comparison routes
    Route::post('/compare', [ComparisonController::class, 'compare']);
    Route::get('/region-stats', [ComparisonController::class, 'regionStats']);
});
