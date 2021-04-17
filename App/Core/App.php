<?php

require_once __DIR__ . "/Autoload.php";

class App
{
    private $route;

    public static $config;

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

    public function run()
    {
        $this->route->run();
    }
}