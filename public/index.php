<?php

require_once __DIR__ . "/../App/Core/App.php";
$config = require_once __DIR__ . "/../config/main.php";

App::setConfig($config);

$app = new App();
$app->run();
