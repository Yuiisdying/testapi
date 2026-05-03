<?php

namespace App\Controllers;

use App\Models\Disaster;
use App\Services\DisasterSyncService;

class DisasterController {
    protected $disaster;
    protected $syncService;
    
    public function __construct() {
        $this->disaster = new Disaster();
        $this->syncService = new DisasterSyncService();
    }
    
    public function index() {
        header('Content-Type: application/json');
        
        $disasters = $this->disaster->getAll(250);
        
        echo json_encode([
            'status' => 'success',
            'count' => count($disasters),
            'data' => $disasters,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }
    
    public function getByType($type) {
        header('Content-Type: application/json');
        
        $disasters = $this->disaster->getByType($type);
        
        echo json_encode([
            'status' => 'success',
            'type' => $type,
            'count' => count($disasters),
            'data' => $disasters
        ]);
    }
    
    public function sync() {
        header('Content-Type: application/json');
        
        try {
            $results = $this->syncService->syncAll();
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Disaster sync completed',
                'results' => $results,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
    
    public function stats() {
        header('Content-Type: application/json');
        
        $earthquakes = $this->disaster->getByType('earthquake');
        $tsunamis = $this->disaster->getByType('tsunami');
        $floods = $this->disaster->getByType('flood');
        $storms = $this->disaster->getByType('storm');
        $volcanoes = $this->disaster->getByType('volcano');
        
        echo json_encode([
            'status' => 'success',
            'stats' => [
                'earthquakes' => count($earthquakes),
                'tsunamis' => count($tsunamis),
                'floods' => count($floods),
                'storms' => count($storms),
                'volcanoes' => count($volcanoes),
                'total' => count($earthquakes) + count($tsunamis) + count($floods) + count($storms) + count($volcanoes)
            ],
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }
}
