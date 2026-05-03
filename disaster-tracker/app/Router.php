<?php

namespace App;

class Router {
    protected $routes = [];
    
    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }
    
    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }
    
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove common base paths (handle both web and CLI contexts)
        $basePaths = [
            '/tugas/disaster-tracker/public',  // Web context
            '/public',                          // Relative context
            '',                                 // Root context
        ];
        
        foreach ($basePaths as $base) {
            if (strpos($path, $base) === 0 && !empty($base)) {
                $path = substr($path, strlen($base));
                break;
            }
        }
        
        // Ensure path starts with /
        if (empty($path) || $path[0] !== '/') {
            $path = '/' . ltrim($path, '/');
        }
        $path = $path ?: '/';
        
        // Try exact match first
        if (isset($this->routes[$method][$path])) {
            $callback = $this->routes[$method][$path];
            
            if (is_array($callback)) {
                $controller = new $callback[0]();
                return $controller->{$callback[1]}();
            }
            
            return $callback();
        }
        
        // Try pattern matching
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $routePath => $callback) {
                $pattern = $this->pathToRegex($routePath);
                if (preg_match($pattern, $path, $matches)) {
                    array_shift($matches); // Remove full match
                    
                    if (is_array($callback)) {
                        $controller = new $callback[0]();
                        return $controller->{$callback[1]}(...array_values($matches));
                    }
                    
                    return $callback(...array_values($matches));
                }
            }
        }
        
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }
    
    protected function pathToRegex($path) {
        $pattern = preg_replace('/\(:any\)/', '([^/]+)', $path);
        $pattern = preg_replace('/\(:num\)/', '([0-9]+)', $pattern);
        return '#^' . $pattern . '$#';
    }
}
