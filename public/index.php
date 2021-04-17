<?php

require_once __DIR__ . "/../app/Core/App.php";
$config = require_once __DIR__ . "/../config/main.php";

$app = new App();
$app::setConfig($config);
$app->run();
