<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;

class Controller
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
}