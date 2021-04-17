<?php

namespace App\Core;

use App;

class Controller
{
    public function __construct()
    {
    }

    public function redirect($url, $isEnd = true, $responseCode = 302)
    {
        header('Location:'.$url, true, $responseCode);
        if ($isEnd){
            die;
        }
    }

    public function render($view, $data = null)
    {
        $controller = App::getController();
        $folderView = strtolower(str_replace('Controller', '', $controller));
        $rootDir = App::$config['rootDir'];

        $viewPath = $rootDir.'\\App\\Views\\'.$folderView.'\\'.$view.'.php';

        if (file_exists($viewPath)) {
            require $viewPath;
        }
    }

    public function renderPartial()
    {

    }
}