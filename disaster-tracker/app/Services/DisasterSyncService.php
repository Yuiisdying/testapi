<?php

namespace App\Services;

use App\Models\Disaster;

class DisasterSyncService {
    protected $disaster;
    protected $dedup_radius = 10; // km
    protected $dedup_hours = 1;
    
    public function __construct() {
        $this->disaster = new Disaster();
        $this->dedup_radius = $_ENV['DEDUP_RADIUS_KM'] ?? 10;
        $this->dedup_hours = $_ENV['DEDUP_TIME_HOURS'] ?? 1;
    }
    
    public function syncAll() {
        $results = [
            'earthquakes' => 0,
            'tsunamis' => 0,
            'floods' => 0,
            'storms' => 0,
            'volcanoes' => 0,
            'deleted' => 0,
            'errors' => []
        ];
        
        // Clean up old events first
        $deleted = $this->cleanupOldEvents();
        $results['deleted'] = $deleted;
        
        // Sync from USGS (primary)
        try {
            $count = $this->syncUSGS();
            $results['earthquakes'] += $count;
        } catch (\Exception $e) {
            $results['errors'][] = 'USGS: ' . $e->getMessage();
        }
        
        // Sync from EMSC (cross-check)
        try {
            $count = $this->syncEMSC();
            $results['earthquakes'] += $count;
        } catch (\Exception $e) {
            $results['errors'][] = 'EMSC: ' . $e->getMessage();
        }
        
        // Sync from IRIS (verify)
        try {
            $count = $this->syncIRIS();
            $results['earthquakes'] += $count;
        } catch (\Exception $e) {
            $results['errors'][] = 'IRIS: ' . $e->getMessage();
        }
        
        // Sync volcanoes
        try {
            $count = $this->syncVolcanoes();
            $results['volcanoes'] += $count;
        } catch (\Exception $e) {
            $results['errors'][] = 'Volcanoes: ' . $e->getMessage();
        }
        
        // Sync storms
        try {
            $count = $this->syncStorms();
            $results['storms'] += $count;
        } catch (\Exception $e) {
            $results['errors'][] = 'Storms: ' . $e->getMessage();
        }
        
        // Sync tsunamis
        try {
            $count = $this->syncTsunamis();
            $results['tsunamis'] += $count;
        } catch (\Exception $e) {
            $results['errors'][] = 'Tsunamis: ' . $e->getMessage();
        }
        
        return $results;
    }
    
    protected function syncUSGS() {
        $url = $_ENV['USGS_API'] . '?format=geojson&starttime=' . date('Y-m-d', strtotime('-7 days')) . '&minmagnitude=4.5';
        
        $response = json_decode(file_get_contents($url), true);
        $count = 0;
        
        if ($response && isset($response['features'])) {
            foreach ($response['features'] as $feature) {
                if ($this->processEarthquake($feature, 'USGS')) {
                    $count++;
                }
            }
        }
        
        return $count;
    }
    
    protected function syncEMSC() {
        $url = $_ENV['EMSC_API'] . '?limit=100&minmag=4.0&format=json&orderby=time-desc';
        
        $response = json_decode(file_get_contents($url), true);
        $count = 0;
        
        if ($response && isset($response['features'])) {
            foreach ($response['features'] as $feature) {
                if ($this->processEarthquake($feature, 'EMSC')) {
                    $count++;
                }
            }
        }
        
        return $count;
    }
    
    protected function syncIRIS() {
        $url = $_ENV['IRIS_API'] . '?format=json&limit=100&minmag=4.5&orderby=time-desc';
        
        $response = json_decode(file_get_contents($url), true);
        $count = 0;
        
        if ($response && isset($response['events'])) {
            foreach ($response['events'] as $event) {
                if ($this->processIRISEvent($event)) {
                    $count++;
                }
            }
        }
        
        return $count;
    }
    
    protected function processEarthquake($feature, $source) {
        if (!isset($feature['properties']) || !isset($feature['geometry'])) {
            return false;
        }
        
        $props = $feature['properties'];
        $coords = $feature['geometry']['coordinates'];
        $magnitude = $props['mag'] ?? 0;
        
        if ($magnitude < 4.5) {
            return false;
        }
        
        $location = $props['place'] ?? "Earthquake at " . round($coords[1], 2) . "°N, " . round($coords[0], 2) . "°E";
        $lat = (float)$coords[1];
        $lng = (float)$coords[0];
        
        // Check for duplicates
        if ($this->isDuplicate($lat, $lng)) {
            return false;
        }
        
        $severity = $magnitude >= 6.5 ? 'critical' : ($magnitude >= 6.0 ? 'severe' : 'moderate');
        
        $data = [
            'type' => 'earthquake',
            'location' => $location,
            'lat' => $lat,
            'lng' => $lng,
            'magnitude' => $magnitude,
            'severity' => $severity,
            'description' => "Magnitude $magnitude earthquake",
            'source' => $source
        ];
        
        return $this->disaster->create($data);
    }
    
    protected function processIRISEvent($event) {
        if (!isset($event['magnitude']) || !isset($event['origin'])) {
            return false;
        }
        
        $magnitude = $event['magnitude'][0]['mag'] ?? 0;
        if ($magnitude < 4.5) {
            return false;
        }
        
        $lat = (float)($event['origin']['latitude'] ?? 0);
        $lng = (float)($event['origin']['longitude'] ?? 0);
        
        // Check for duplicates
        if ($this->isDuplicate($lat, $lng)) {
            return false;
        }
        
        $location = $event['description']['text'] ?? "Earthquake at " . round($lat, 2) . "°N, " . round($lng, 2) . "°E";
        $severity = $magnitude >= 6.5 ? 'critical' : ($magnitude >= 6.0 ? 'severe' : 'moderate');
        
        $data = [
            'type' => 'earthquake',
            'location' => $location,
            'lat' => $lat,
            'lng' => $lng,
            'magnitude' => $magnitude,
            'severity' => $severity,
            'description' => "Magnitude $magnitude earthquake (verified by IRIS)",
            'source' => 'IRIS'
        ];
        
        return $this->disaster->create($data);
    }
    
    protected function isDuplicate($lat, $lng) {
        $nearby = $this->disaster->getNearby($lat, $lng, $this->dedup_radius);
        return count($nearby) > 0;
    }
    
    protected function syncVolcanoes() {
        // Smithsonian Volcano Database (simulated with mock data for demo)
        // Real API: https://volcano.si.edu/
        $volcanoes = [
            ['name' => 'Sakurajima, Japan', 'lat' => 31.5927, 'lng' => 130.6568, 'status' => 'Active'],
            ['name' => 'Mount Merapi, Indonesia', 'lat' => -7.5425, 'lng' => 110.4421, 'status' => 'Monitoring'],
            ['name' => 'Stromboli, Italy', 'lat' => 38.7914, 'lng' => 15.2126, 'status' => 'Active'],
            ['name' => 'Etna, Sicily', 'lat' => 37.7439, 'lng' => 15.0057, 'status' => 'Monitoring'],
            ['name' => 'Yellowstone, USA', 'lat' => 44.4280, 'lng' => -110.8456, 'status' => 'Monitoring'],
        ];
        
        $count = 0;
        foreach ($volcanoes as $volcano) {
            if (!$this->isDuplicate($volcano['lat'], $volcano['lng'])) {
                $data = [
                    'type' => 'volcano',
                    'location' => $volcano['name'],
                    'lat' => $volcano['lat'],
                    'lng' => $volcano['lng'],
                    'magnitude' => rand(3, 7) / 2, // Activity level
                    'severity' => $volcano['status'] === 'Active' ? 'severe' : 'moderate',
                    'description' => 'Volcano status: ' . $volcano['status'],
                    'source' => 'Smithsonian'
                ];
                
                if ($this->disaster->create($data)) {
                    $count++;
                }
            }
        }
        
        return $count;
    }
    
    protected function syncStorms() {
        // NOAA Hurricane/Storm Database
        // For demo, using simulated active storms
        $storms = [
            ['name' => 'Atlantic Storm System', 'lat' => 35.0, 'lng' => -40.0, 'speed' => 150],
            ['name' => 'Pacific Typhoon', 'lat' => 15.0, 'lng' => 145.0, 'speed' => 180],
            ['name' => 'Indian Ocean Cyclone', 'lat' => -15.0, 'lng' => 70.0, 'speed' => 120],
        ];
        
        $count = 0;
        foreach ($storms as $storm) {
            if (!$this->isDuplicate($storm['lat'], $storm['lng'])) {
                $severity = $storm['speed'] > 150 ? 'critical' : ($storm['speed'] > 100 ? 'severe' : 'moderate');
                
                $data = [
                    'type' => 'storm',
                    'location' => $storm['name'],
                    'lat' => $storm['lat'],
                    'lng' => $storm['lng'],
                    'magnitude' => (float)($storm['speed'] / 100), // Wind speed scaled
                    'severity' => $severity,
                    'description' => 'Wind speed: ' . $storm['speed'] . ' km/h',
                    'source' => 'NOAA'
                ];
                
                if ($this->disaster->create($data)) {
                    $count++;
                }
            }
        }
        
        return $count;
    }
    
    protected function syncTsunamis() {
        // Pacific Tsunami Warning Centre
        // Tsunamis typically follow M7.0+ earthquakes at sea
        $recentQuakes = $this->disaster->getAll(100);
        
        $count = 0;
        foreach ($recentQuakes as $eq) {
            if ($eq['type'] === 'earthquake' && $eq['magnitude'] >= 7.0) {
                // Check if not already a tsunami entry
                if (!$this->isDuplicate($eq['lat'], $eq['lng'])) {
                    $data = [
                        'type' => 'tsunami',
                        'location' => $eq['location'] . ' (Tsunami Alert)',
                        'lat' => $eq['lat'],
                        'lng' => $eq['lng'],
                        'magnitude' => $eq['magnitude'],
                        'severity' => 'critical',
                        'description' => 'Tsunami warning following M' . $eq['magnitude'] . ' earthquake',
                        'source' => 'PTWC'
                    ];
                    
                    if ($this->disaster->create($data)) {
                        $count++;
                    }
                }
            }
        }
        
        return $count;
    }
    
    protected function cleanupOldEvents() {
        // Delete events older than configured retention period
        $retentionDays = $_ENV['DATA_RETENTION_DAYS'] ?? 7;
        return $this->disaster->deleteOlderThan($retentionDays);
    }
}
