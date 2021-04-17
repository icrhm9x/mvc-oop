<?php

require_once __DIR__ . "/Route.php";
require_once __DIR__ . "/../Controllers/HomeController.php";

class App
{
    private $route;

    function __construct()
    {
        $this->route = new Route();

        $this->route->get('/', 'HomeController@index');

        $this->route->get('/user/{id}/{abc}', function ($id, $abc){
            echo 'Day la trang user'.$id;
            echo 'Day la trang user'.$abc;
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