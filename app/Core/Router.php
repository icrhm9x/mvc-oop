<?php

class Router
{
    private $routers = [];

    function __construct()
    {
    }

    private function getRequestURL()
    {
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $url = str_replace('/public', '', $url);
        $url = $url === ''  || empty($url) ? '/' : $url;
        return $url;
    }

    private function getRequestMethod()
    {
        $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
        return $method;
    }

    private function addRouter($method, $url, $action)
    {
        $this->routers[] = [$method, $url, $action];
    }

    function get($url, $action)
    {
        $this->addRouter('GET', $url, $action);
    }

    function post($url, $action)
    {
        $this->addRouter('POST', $url, $action);
    }

    function any($url, $action)
    {
        $this->addRouter('GET|POST', $url, $action);
    }

    function map()
    {
        $requestURL = $this->getRequestURL();
        $requestMethod = $this->getRequestMethod();

        $routers = $this->routers;
        foreach ($routers as $router){
            list($method, $url, $action) = $router;
            if (strpos($method, $requestMethod) !== False ){
                if (strcmp(strtolower($url), strtolower($requestURL)) === 0){
                    if (is_callable($action)){
                        $action();
                        return;
                    }
                }else{
                    continue;
                }
            }else{
                continue;
            }
        }
        return;
    }

    function run()
    {
        $this->map();
    }
}