<?php
/**
 * Created by PhpStorm.
 * User: taras
 * Date: 14.11.17
 * Time: 17:25
 */

namespace App\Library;

class FrontController
{
    public function run()
    {
        $route = $_GET['route'] ?? 'home/index';
        $parts = explode('/', $route);

        $controller_class = 'App\Controllers\\' . ucfirst($parts[0]) . 'Controller';
        $controller_action = $parts[1];

        $controller = new $controller_class();
        echo $controller->$controller_action();
    }
}