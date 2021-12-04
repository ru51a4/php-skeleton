<?php

require_once __DIR__ . '/../app/Defines.php';
require_once ROOT . '/vendor/autoload.php';

use App\Core\Application;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'   => 'sqlite',
    'database' => __DIR__.'/../db',
    'prefix'   => '',
], 'default');

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$app = new Application();
$app->run();