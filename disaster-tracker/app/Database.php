<?php

namespace App;

class Database {
    protected static $instance = null;
    protected $conn = null;
    
    protected function __construct() {
        $this->conn = new \mysqli(
            $_ENV['DB_HOST'] ?? 'localhost',
            $_ENV['DB_USERNAME'] ?? 'root',
            $_ENV['DB_PASSWORD'] ?? '',
            $_ENV['DB_DATABASE'] ?? 'tugas'
        );
        
        if ($this->conn->connect_error) {
            die('Database connection failed: ' . $this->conn->connect_error);
        }
        
        $this->conn->set_charset('utf8mb4');
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function query($sql) {
        return $this->conn->query($sql);
    }
    
    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }
    
    public function getAffectedRows() {
        return $this->conn->affected_rows;
    }
    
    public function close() {
        $this->conn->close();
    }
}
