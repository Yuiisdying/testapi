<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use App\Models\Animal;

class SeedGBIFAnimals extends Command
{
    protected $signature = 'animals:seed-gbif {--fresh : Delete existing animals first}';
    protected $description = 'Seed animals from GBIF (300) with automatic deduplication';

    public function handle()
    {
        $this->info('🌍 Indonesian Biodiversity GBIF Seeder');
        $this->line('=====================================');

        // Show current count
        $current = Animal::count();
        $this->info("Current animals in DB: $current");

        if ($current > 0 && !$this->option('fresh')) {
            if (!$this->confirm('Animals exist. Replace with GBIF data?')) {
                $this->info('Aborted.');
                return;
            }
        }

        // Backup current data
        if ($current > 0) {
            $this->info('Creating backup...');
            $backup = Animal::with(['speciesType', 'conservationStatus'])->get()->toArray();
            file_put_contents(
                storage_path('backups/animals-backup-' . now()->format('Y-m-d-His') . '.json'),
                json_encode($backup, JSON_PRETTY_PRINT)
            );
            $this->line('✓ Backup saved to storage/backups/');
        }

        // Run the GBIF seeder
        $this->info('🚀 Fetching animals from GBIF (~300)...');
        $this->call('db:seed', [
            '--class' => 'Database\Seeders\GBIFAnimalSeeder',
        ]);

        // Show new count
        $newCount = Animal::count();
        $this->info("✓ Complete! Now have $newCount animals");
        $this->line("Added: " . ($newCount - $current) . " new animals");
    }
}
