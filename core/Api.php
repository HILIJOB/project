<?php

namespace app\core;

use app\core\Router;

class Api{
    public Router $router;
    public function __construct()
    {
        $this->router = new Router();
    }
    public function start()
    {
        $this->router->callFunc();
    }
}
