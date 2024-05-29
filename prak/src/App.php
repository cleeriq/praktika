<?php

namespace Ven\App;

use Ven\App\Router\Router;

class App {


    public function run() {

        $router = new Router;

        $uri = $_SERVER['REQUEST_URI'];
        $uri = str_contains($uri, '?') ? strstr($uri, '?', true) : $uri;

        
        $method = $_SERVER['REQUEST_METHOD'];

        $router->move($uri, $method);
    }
}