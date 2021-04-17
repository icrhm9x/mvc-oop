<?php

class Autoload
{
    private $rootDir;

    function __construct($rootDir)
    {
        $this->rootDir = $rootDir;

        spl_autoload_register([$this, 'autoLoad']);

        $this->autoLoadFile();
    }

    private function autoLoad($class)
    {
        $filePath = $this->rootDir . '\\' . $class . '.php';

        if (file_exists($filePath)) {
            require_once $filePath;
        }else{
            die("$class does not exists");
        }
    }

    private function autoLoadFile()
    {
        foreach ($this->defaultFileLoad() as $file) {
            require_once $this->rootDir.'/'.$file;
        }
    }

    private function defaultFileLoad()
    {
        return[
          'App/Core/Route.php',
          'App/routes.php'
        ];
    }
}