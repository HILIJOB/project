<?php

namespace app\core;

class Request {

    public string $httpMethod;
    private array $postParams;
    private string $path;
    private array $headers;

    public function __construct($httpMethod, $path, $postParams, $headers) 
    {
        $this->httpMethod = $httpMethod;
        $this->postParams = $postParams;
        $this->path = $path;
        $this->headers = $headers;
    }

    public function getMethod()
    {
        return $this->httpMethod;
    }

    public function getParams($key) 
    {
        return $this->postParams[$key];
    }
    
    public function getPath() 
    {
        return $this->path;
    }

    public function getHeaders() 
    {
        return $this->headers;
    }
}