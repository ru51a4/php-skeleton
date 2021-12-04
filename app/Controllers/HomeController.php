<?php

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
        $data = Post::all()->toArray();
        return $this->response->render('home.index', compact('data'));
    }

    public function routeparams()
    {
        $id = $this->request->routeparams['id'];
        var_dump(Post::find($id)->toArray());
    }
}