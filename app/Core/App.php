<?php

require_once __DIR__ . "/Route.php";

class App
{
    private $route;

    function __construct()
    {
        $this->route = new Route();
        $this->route->get('/', function (){
            echo 'Day la trang home';
        });
        $this->route->get('/user/{id}/{abc}', function (){
            echo 'Day la trang user';
        });
        $this->route->post('/news', function (){
            echo 'Day la trang news';
        });
        $this->route->any('/product', function (){
            echo 'Day la trang product';
        });
    }

    function run()
    {
        $this->route->run();
    }
}