<?php

require_once __DIR__ . '/../app/Defines.php';
require_once ROOT . '/vendor/autoload.php';

use App\Library\FrontController;

$app = new FrontController();
$app->run();