<?php
/**
 * Created by PhpStorm.
 * User: taras
 * Date: 14.11.17
 * Time: 17:31
 */

namespace App\Controllers;
use App\Models\Post;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController extends Controller
{
    public function index()
    {
        $posts = (new Post())->getAll();
        $this->view->render('home.index', compact('posts'));
    }
}