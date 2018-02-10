<?php

namespace App\Library;

use App\Route;

class FrontController
{
    protected $request;
    protected $response;

    /**
     * Controller constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function run()
    {
        if(empty($route = $this->getRoute())){
            $this->sendNotFound();
        }

        @list($controller_name, $action_name) = explode('@', $route, 2);

        if(!$controller_name or !$action_name){
            $this->sendNotFound();
        }

        $controller_class = $this->getControllerClassOrFail($controller_name);
        $controller_action = $this->getControllerActionOrFail($controller_class, $action_name);

        $controller = new $controller_class($this->request, $this->response);
        $response = $controller->$controller_action();

        if($response instanceof Response){
            $response->send();
        }
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
            $this->sendNotFound();
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
            $this->sendNotFound();
        }
    }

    private function sendNotFound()
    {
        $this->response->notFound();
        $this->response->send();
    }

    /**
     * @return string|null
     */
    private function getRoute()
    {
        return Route::rules()[$this->request->path] ?? null;
    }
}