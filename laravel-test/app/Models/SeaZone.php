<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SeaZone extends Model
{
    protected $fillable = [
        'name',
        'description',
        'region_type',
        'center_latitude',
        'center_longitude',
        'depth_range',
        'water_type',
        'ecosystem_description',
        'area_sq_km',
        'boundary_coordinates',
    ];

    protected $casts = [
        'boundary_coordinates' => 'array',
    ];

    /**
     * Get all animals found in this sea zone.
     */
    public function animals(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_sea_zone');
    }
}
