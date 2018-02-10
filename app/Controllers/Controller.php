<?php

namespace App\Controllers;

use App\Library\Request;
use App\Library\Response;
use App\Library\View;

class Controller
{
    protected $request;
    protected $response;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    protected function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        $this->response->render('error.404');
        exit();
    }
}