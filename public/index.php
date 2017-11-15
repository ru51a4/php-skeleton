<?php
/**
 * Created by PhpStorm.
 * User: taras
 * Date: 14.11.17
 * Time: 11:37
 */

use App\Library\FrontController;
use App\Library\Autoloader;

define('ROOT', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);

require_once APP . 'library/Autoloader.php';
require_once ROOT . '/vendor/autoload.php';

$autoloader = new Autoloader();
$autoloader->register();

$app = new FrontController();
$app->run();