<?php

namespace App\Models;

use App\Database;

class Disaster {
    protected $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function create($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO disasters (type, location, lat, lng, magnitude, severity, description, source) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        
        $stmt->bind_param(
            'ssdddsss',
            $data['type'], $data['location'], $data['lat'], $data['lng'],
            $data['magnitude'], $data['severity'], $data['description'], $data['source']
        );
        
        return $stmt->execute();
    }
    
    public function findBy($field, $value) {
        $result = $this->db->query("SELECT * FROM disasters WHERE $field = '$value'");
        return $result ? $result->fetch_assoc() : null;
    }
    
    public function getNearby($lat, $lng, $radius = 10) {
        // Get disasters within radius (km) in last hour
        $sql = "SELECT * FROM disasters 
                WHERE (6371 * acos(cos(radians($lat)) * cos(radians(lat)) * cos(radians(lng) - radians($lng)) + sin(radians($lat)) * sin(radians(lat)))) < $radius
                AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)
                ORDER BY created_at DESC";
        
        $result = $this->db->query($sql);
        $disasters = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $disasters[] = $row;
            }
        }
        
        return $disasters;
    }
    
    public function getAll($limit = 250) {
        $result = $this->db->query("SELECT * FROM disasters ORDER BY created_at DESC LIMIT $limit");
        $disasters = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $disasters[] = $row;
            }
        }
        
        return $disasters;
    }
    
    public function getByType($type, $limit = 100) {
        $result = $this->db->query("SELECT * FROM disasters WHERE type = '$type' ORDER BY created_at DESC LIMIT $limit");
        $disasters = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $disasters[] = $row;
            }
        }
        
        return $disasters;
    }
    
    public function deleteOlderThan($days) {
        // Delete events older than specified days
        $sql = "DELETE FROM disasters WHERE created_at < DATE_SUB(NOW(), INTERVAL $days DAY)";
        $result = $this->db->query($sql);
        
        if ($result) {
            return $this->db->getAffectedRows();
        }
        
        return 0;
    }
}
