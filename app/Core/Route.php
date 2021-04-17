<?php

class Route
{
    private $routes;

    function __construct()
    {
        $this->routes = [];
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
        // kiểm tra xem URL có chứa param không. VD: post/{id}
        if (preg_match_all('/({([a-zA-Z]+)})/', $url, $params)) {
            // thay thế param bằng (.+). VD: post/{id} -> post/(.+)
            $url = preg_replace('/({([a-zA-Z]+)})/', '(.+)', $url);
        }

        // Thay thế tất cả các kí tự / bằng ký tự \/ (regex) trong URL.
        $url = str_replace('/', '\/', $url);

        // Tạo một route mới
        $route = [
            'url' => $url,
            'method' => $method,
            'action' => $action,
            'params' => $params[2]
        ];

        // Thêm route vào router.
        array_push($this->routes, $route);
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

        $routes = $this->routes;
        foreach ($routes as $route){
            if (strpos($route['method'], $requestMethod) !== false) {

                // kiểm tra route hiện tại có phải là url đang được gọi.
                $reg = '/^' . $route['url'] . '$/';
                if (preg_match($reg, $requestURL, $params)) {
                    array_shift($params);
                    $this->call_action_route($route['action'], $params);
                    return;
                }
            }
        }
        // nếu không khớp với bất kì route nào cả.
        echo '404 - Not Found';
        return;
    }

    private function call_action_route($action, $params)
    {
        // Nếu $action là một callback (một hàm).
        if (is_callable($action)) {
            call_user_func_array($action, $params);
            return;
        }

        // Nếu $action là một phương thức của controller. VD: 'HomeController@index'.
        if (is_string($action)) {
            if (count(explode('@', $action)) !== 2) {
                die('Router error');
            }
            $action = explode('@', $action);
            $className = $action[0];
            $methodName = $action[1];

            $controllerName = 'App\\Controllers\\' . $className;

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controllerName, $methodName)) {
                    call_user_func_array([$controller, $methodName], $params);
                }else{
                    die('Method "' . $methodName . '" in Class "' . $controllerName . '" not found');
                }
            }else{
                die('Class "' . $controllerName . '" not found');
            }

            return;
        }
    }

    function run()
    {
        $this->map();
    }
}