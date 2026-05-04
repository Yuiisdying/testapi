<?php

namespace App\Console\Commands;

use App\Models\Animal;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchAnimalImages extends Command
{
    protected $signature = 'biodiversity:fetch-images';
    protected $description = 'Fetch animal images from Wikimedia Commons using Wikipedia API';

    public function handle()
    {
        $this->info('🖼️  Fetching animal images from Wikipedia...');
        $updated = 0;
        $animals = Animal::whereNull('image_url')->take(100)->get();

        foreach ($animals as $animal) {
            $imageUrl = $this->getWikipediaImage($animal->scientific_name);
            
            if ($imageUrl) {
                $animal->update(['image_url' => $imageUrl]);
                $this->line("✅ {$animal->name}: {$imageUrl}");
                $updated++;
            } else {
                $this->line("⏭️  {$animal->name}: No image found");
            }
        }

        $this->info("\n✨ Success!");
        $this->info("📸 Updated: {$updated} animals");
    }

    private function getWikipediaImage($scientificName)
    {
        try {
            // Get page from Wikipedia
            $response = Http::get('https://en.wikipedia.org/w/api.php', [
                'action' => 'query',
                'titles' => $scientificName,
                'prop' => 'pageimages',
                'pithumbsize' => 500,
                'format' => 'json',
            ]);

            $data = $response->json();
            $pages = $data['query']['pages'] ?? [];
            
            foreach ($pages as $page) {
                if (isset($page['thumbnail']['source'])) {
                    return $page['thumbnail']['source'];
                }
            }

            // Try with common name as fallback
            $response = Http::get('https://commons.wikimedia.org/w/api.php', [
                'action' => 'query',
                'list' => 'search',
                'srsearch' => $scientificName . ' animal',
                'format' => 'json',
            ]);

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
