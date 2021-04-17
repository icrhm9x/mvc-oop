<?php

namespace App\Controllers;

require_once __DIR__ . "/../Controllers/Controller.php";

use App\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
//        echo 'home controller';
    }

    public function index()
    {
        echo 'home index';
    }
}