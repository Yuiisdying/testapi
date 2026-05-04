<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Animal extends Model
{
    protected $fillable = [
        'name',
        'scientific_name',
        'common_name',
        'description',
        'species_type_id',
        'conservation_status_id',
        'habitat',
        'diet',
        'image_url',
        'estimated_population',
        'population_trend',
    ];

    /**
     * Get the species type this animal belongs to.
     */
    public function speciesType(): BelongsTo
    {
        return $this->belongsTo(SpeciesType::class, 'species_type_id');
    }

    /**
     * Get the conservation status of this animal.
     */
    public function conservationStatus(): BelongsTo
    {
        return $this->belongsTo(ConservationStatus::class, 'conservation_status_id');
    }

    /**
     * Get all regions this animal is found in.
     */
    public function regions(): BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'animal_region');
    }

    /**
     * Get all sea zones this animal is found in.
     */
    public function seaZones(): BelongsToMany
    {
        return $this->belongsToMany(SeaZone::class, 'animal_sea_zone');
    }
}
