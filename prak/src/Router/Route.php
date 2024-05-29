<?php

namespace Ven\App\Router;

class Route {

    public function __construct(
        private $uri,
        private $method,
        private $action
    ) {}


    public static function get($uri, $action) {
        return new static($uri, method: "GET", action: $action);
    }


    public static function post($uri, $action) {
        return new static($uri, method: "POST", action: $action);
    }

    public function getMethod() {
        return $this->method;
    }

    public function getUri() {
        return $this->uri;
    }

    public function getAction() {
        return $this->action;
    }
}