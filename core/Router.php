<?php

namespace app\core;

use app\core\Request;

class Router {

    private Request $request;

    public function __construct(private $container) 
    {
        $raw = empty(json_decode(file_get_contents('php://input'),true)) ? [] : json_decode(file_get_contents('php://input'),true);
        $_POST = empty($_POST) ? [] : $_POST;
        $this->request = new Request($_SERVER["REQUEST_METHOD"], $_SERVER['REQUEST_URI'], array_merge($raw,$_POST), $_GET);
    }

    public function handleRequest()
    {

        if ($this->request->getPath()) {

            $requestPath = $this->request->getPath();
            $query = parse_url($requestPath, PHP_URL_QUERY);
            parse_str($query, $path);

            $action = ucfirst($path['act']);

            $method = $path['method'];
            $controllerName = 'app\\controllers' . '\\' . $action . 'Controller';
            if (class_exists($controllerName)) {
                $controller = $this->container->get($controllerName);
                if ($this->request->getMethod() == "GET"){
                    $controller->$method();
                } else {
                    $controller->$method($this->request);
                }
            }
        }
        
    }
}