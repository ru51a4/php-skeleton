<?php
/**
 * Created by PhpStorm.
 * User: taras
 * Date: 18.11.17
 * Time: 9:27
 */

namespace App\Library;

/**
 * Class View
 * @package App\Library
 */
class View
{

    const PATH = APP . 'views' . DIRECTORY_SEPARATOR;
    const LAYOUT = 'layout.php';

    /**
     * @param $template
     * @param array $params
     */
    public function render($template, $params = [])
    {
        $template_path = self::PATH .
            str_replace('.', DIRECTORY_SEPARATOR, $template) . '.php';

        extract($params);

        ob_start();
        include $template_path;
        $content =  ob_get_clean();

        include self::PATH . self::LAYOUT;
    }


}