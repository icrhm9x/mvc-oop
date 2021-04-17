<?php

namespace App\Controllers;

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