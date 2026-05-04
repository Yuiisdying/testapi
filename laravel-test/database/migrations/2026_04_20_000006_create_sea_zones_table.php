<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sea_zones', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., "Andaman Sea", "South China Sea"
            $table->text('description')->nullable(); // Geographic/ecological info
            $table->string('region_type'); // 'sea', 'strait', 'gulf', 'bay'
            $table->decimal('center_latitude', 10, 6); // Center point for map
            $table->decimal('center_longitude', 10, 6);
            $table->string('depth_range')->nullable(); // e.g., "0-4000m"
            $table->string('water_type'); // 'saltwater', 'brackish'
            $table->text('ecosystem_description')->nullable(); // Coral reefs, mangroves, etc.
            $table->integer('area_sq_km')->nullable(); // Surface area in square kilometers
            $table->json('boundary_coordinates')->nullable(); // For drawing on map (polygon points)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sea_zones');
    }
};
