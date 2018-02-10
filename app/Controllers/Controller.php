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
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}