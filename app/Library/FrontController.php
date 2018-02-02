<?php
/**
 * Created by PhpStorm.
 * User: taras
 * Date: 14.11.17
 * Time: 17:25
 */

namespace App\Library;

use App\Controllers\Controller;
use App\Route;

/**
 * Class FrontController
 * @package App\Library
 */
class FrontController extends Controller
{

    public function run()
    {
        if(empty($route = $this->getRoute())){
            $this->notFound();
        }

        @list($controller_name, $action_name) = explode('@', $route, 2);

        if(!$controller_name or !$action_name){
            $this->notFound();
        }

        $controller_class = $this->getControllerClassOrFail($controller_name);
        $controller_action = $this->getControllerActionOrFail($controller_class, $action_name);

        $controller = new $controller_class();
        $controller->$controller_action();
    }

    /**
     * @param $name string
     * @return mixed
     */
    private function getControllerClassOrFail($name)
    {
        $controller_class = 'App\Controllers\\' . $name;

        if (class_exists($controller_class)) {
            return $controller_class;
        } else {
            $this->notFound();
        }
    }

    /**
     * @param $controller_class string
     * @param $name string
     * @return mixed
     */
    private function getControllerActionOrFail($controller_class, $name)
    {
        if (method_exists($controller_class, $name)) {
            return $name;
        } else {
            $this->notFound();
        }
    }

    /**
     * @return null
     */
    private function getRoute()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        return Route::rules()[$path] ?? null;
    }
}