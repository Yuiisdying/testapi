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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('scientific_name')->nullable();
            $table->string('common_name')->nullable();
            $table->text('description');
            $table->foreignId('species_type_id')->constrained('species_types')->onDelete('cascade');
            $table->foreignId('conservation_status_id')->constrained('conservation_statuses')->onDelete('cascade');
            $table->text('habitat')->nullable();
            $table->text('diet')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('estimated_population')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
