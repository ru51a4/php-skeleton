<?php
/**
 * Created by PhpStorm.
 * User: taras
 * Date: 18.11.17
 * Time: 22:11
 */

namespace App\Library;

/**
 * Class Request
 * @package App\Library
 */
class Request
{
    public $get;
    public $post;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
    }
}