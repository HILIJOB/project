<?php

namespace app\core;

class Request {
    public string $httpMethod;
    public function __construct(string $httpMethod) 
    {
        $this->httpMethod = $httpMethod;
    }
    public function getAct()
    {
        if ($this->httpMethod == "GET") {
            return $_GET['act'];
        }
        if ($this->httpMethod == 'POST') {
            return $_POST['act'];
        }
    }
    public function getMethod()
    {
        if ($this->httpMethod == "GET") {
            return $_GET['method'];
        }
        if ($this->httpMethod == 'POST') {
            return $_POST['method'];
        }
    }
}