<?php

namespace app\core;

use app\core\Router;

class Api{
    public Router $router;
    public function __construct()
    {
        global $container;
        $this->router = new Router($container);
    }
    
    public function start()
    {
        $this->router->handleRequest();
    }
}
