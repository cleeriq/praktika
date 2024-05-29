<?php

namespace Ven\App\Router;

class Router {

    private $routes = [
        "GET" => [],
        "POST" => []
    ];

    public function __construct() {
        $this->initRoutes();
    }


    public function initRoutes() {
        /**
         * @var Route[]
         */
        $routes = require_once APP_PATH."/config/routes.php";

        foreach($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }

    }

    public function move($uri, $method) {
        $route = $this->foundRoude($uri, $method);

        if (!$route) {
            echo '404 | not found';
            exit;
        }

        if (is_array($route->getAction())) {
            [$controller, $action] = $route->getAction();

            $controller = new $controller();
            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());
        }


    }

    public function foundRoude($uri, $method) {
        if (!isset($this->routes[$method][$uri])){
            return false;
        }
        return $this->routes[$method][$uri];
    }
}