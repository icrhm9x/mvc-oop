<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
//        echo 'home controller';
    }

    public function index()
    {
        $this->render('index');
//        $this->redirect('https://www.google.com/');
    }
}