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
        $segments = explode('/', $route);

        $controller_class = $this->getControllerClassOrFail($segments[0]);
        $controller_action = $this->getControllerActionOrFail($controller_class, $segments[1]);

        $controller = new $controller_class();
        echo $controller->$controller_action();
    }

    private function getControllerClassOrFail($name)
    {
        $controller_class = 'App\Controllers\\' . ucfirst($name) . 'Controller';

        if (class_exists($controller_class)) {
            return $controller_class;
        } else {
            header("HTTP/1.0 404 Not Found");
            exit('Page not found!');
        }
    }

    private function getControllerActionOrFail($controller_class, $name)
    {
        if(method_exists($controller_class, $name)){
            return $name;
        }else{
            header("HTTP/1.0 404 Not Found");
            exit('Page not found!');
        }
    }

}