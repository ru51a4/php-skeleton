<?php
/**
 * Created by PhpStorm.
 * User: taras
 * Date: 15.11.17
 * Time: 9:02
 */

namespace App\Library;

class Autoloader
{
    public function register()
    {
        spl_autoload_register(function ($class_name) {

            $parts = explode('\\', $class_name);

            for ($i = 0; $i < count($parts) - 1; $i++) {
                $parts[$i] = strtolower($parts[$i]);
            }

            $file_path = ROOT . implode(DIRECTORY_SEPARATOR, $parts) . '.php';

            if (file_exists($file_path)) {
                require_once $file_path;
            }
        });
    }
}