<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConservationStatus extends Model
{
    protected $fillable = [
        'name',
        'description',
        'color_code',
        'risk_level',
    ];

    /**
     * Get all animals with this conservation status.
     */
    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class, 'conservation_status_id');
    }
}
