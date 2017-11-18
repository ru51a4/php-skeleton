<?php
/**
 * Created by PhpStorm.
 * User: taras
 * Date: 14.11.17
 * Time: 17:31
 */

namespace App\Controllers;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController extends Controller
{
    public function index()
    {
        $text = 'Hello, World!';
        $this->view->render('home.index', compact('text'));
    }
}