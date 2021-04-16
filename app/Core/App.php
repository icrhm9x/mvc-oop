<?php

require_once __DIR__ . "/Router.php";

class App
{
    private $router;

    function __construct()
    {
        $this->router = new Router();
        $this->router->get('/', function (){
            echo 'Day la trang home';
        });
        $this->router->get('/users', function (){
            echo 'Day la trang users';
        });
        $this->router->post('/news', function (){
            echo 'Day la trang news';
        });
        $this->router->any('/product', function (){
            echo 'Day la trang product';
        });
        $this->router->any('*', function (){
            echo '404 not found';
        });
    }

    function run()
    {
        $this->router->run();
    }
}