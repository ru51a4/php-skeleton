<?php

namespace App\Core;

use App\Route;

class Router
{
    private $request;
    private $controller;
    private $action;

    /**
     * Router constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
        @list($this->controller, $this->action) = explode('@', $this->getRoute(), 2);
    }

    /**
     * @return string|null
     */
    public function getRoute()
    {
        //если роуты совпадают и кол-во такое же
        $currentUrl = $this->parseRoute($this->request->path);
        $find = true;
        $params = [];
        foreach (Route::rules() as $key => $item) {
            $currentRouteUrl = $this->parseRoute($key);
            for ($i = 0; $i <= count($currentRouteUrl); $i++) {
                if ($currentRouteUrl[$i]['type'] == "route") {
                    if ($currentRouteUrl[$i]['value'] != $currentUrl[$i]['value']) {
                        $find = false;
                        break;
                    }
                } else {
                    $params[$currentRouteUrl[$i]['value']] = $currentUrl[$i]['value'];
                }
            }
            if ($find && count($currentRouteUrl) == count($currentUrl)) {
                $this->request->routeparams = $params;
                return $item;
            } else {
                $find = true;
                $params = [];
            }
        }
        return null;
    }

    private function parseRoute($url)
    {
        $res = [];
        $url = explode("/", $url);
        foreach ($url as $item) {
            $item = ["type" => "route", "value" => $item];
            if (strpos($item['value'], "{") !== false) {
                $item['type'] = 'parameter';
                $item['value'] = substr($item['value'], 1);
                $item['value'] = substr($item['value'], 0, -1);
            }
            $res[] = $item;
        }
        return $res;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getController()
    {
        $controller = 'App\Controllers\\' . $this->controller;

        if ($this->controller && class_exists($controller)) {
            return $controller;
        } else {
            throw new \Exception();
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getAction()
    {
        if ($this->action && method_exists($this->getController(), $this->action)) {
            return $this->action;
        } else {
            throw new \Exception();
        }
    }
}