<?php
/**
 * Created by PhpStorm.
 * User: taras
 * Date: 18.11.17
 * Time: 9:51
 */

namespace App\Controllers;

use App\Library\View;

/**
 * Class Controller
 * @package App\Controllers
 */
class Controller
{
    protected $view;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->view = new View();
    }

    protected function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        $this->view->render('error.404');
        exit();
    }
}