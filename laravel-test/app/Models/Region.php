<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Region extends Model
{
    protected $fillable = [
        'name',
        'description',
        'island_name',
        'latitude',
        'longitude',
    ];

    /**
     * Get all animals in this region.
     */
    public function animals(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_region');
    }
}
