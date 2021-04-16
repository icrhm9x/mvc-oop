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
        $checkRoute = false;
        $requestURL = $this->getRequestURL();
        $requestMethod = $this->getRequestMethod();

        $routers = $this->routers;
        foreach ($routers as $router){
            list($method, $url, $action) = $router;
            if (strpos($method, $requestMethod) === False ){
                continue;
            }
            if ($url === '*'){
                $checkRoute = true;
            }else{
                if (strcmp(strtolower($url), strtolower($requestURL)) === 0){
                    $checkRoute = true;
                }else{
                    continue;
                }
            }
            if ($checkRoute === true){
                if (is_callable($action)){
                    $action();
                }
                return;
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