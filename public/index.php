<?php

require_once __DIR__ . '/../app/Defines.php';
require_once ROOT . '/vendor/autoload.php';

use App\Library\FrontController;
use App\Library\Response;
use App\Library\Request;

$app = new FrontController(new Request(), new Response());
$app->run();