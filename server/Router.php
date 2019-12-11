<?php 

class Router {

    protected $routes = [];

    public function define($routes) {
    
        $this->routes = $routes;
    }

    public function direct($uri) {
        
        if (array_key_exists($uri, $this->routes)) {
            require $this->routes[$uri];
        };

        throw new Exception('no route defined for that request :/');
    }
    
}