<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpeciesType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
    ];

    /**
     * Get all animals of this species type.
     */
    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class, 'species_type_id');
    }
}
