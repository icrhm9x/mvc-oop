<?php

require_once __DIR__ . "/Autoload.php";

class App
{
    private $route;

    public static $config;
    public static $controller;
    public static $action;

    function __construct()
    {
        new Autoload(self::$config['rootDir']);

        $this->route = new Route(self::$config['basePath']);
    }

    public static function setConfig($config) {
        self::$config = $config;
    }

    public static function getConfig() {
        return self::$config;
    }

    public static function setController($controller) {
        self::$controller = $controller;
    }

    public static function getController() {
        return self::$controller;
    }

    public static function setAction($action) {
        self::$action = $action;
    }

    public static function getAction() {
        return self::$action;
    }

    public function run()
    {
        $this->route->run();
    }
}