<?php

namespace App\Library;

class Response
{
    const PATH = APP . 'Views' . DIRECTORY_SEPARATOR;
    const LAYOUT = 'layout.php';

    private $headers = [];
    private $body;

    public function send()
    {
        foreach ($this->headers as $header) {
            header($header);
        }
        echo $this->body;
        exit;
    }

    /**
     * @param $value
     * @return Response
     */
    public function view($value): Response
    {
        $this->body = $value;

        return $this;
    }

    /**
     * @return Response
     */
    public function notFound(): Response
    {
        $this->error(404, 'Not Found');

        return $this;
    }

    /**
     * @param $status
     * @param $mesage
     * @return Response
     */
    public function error($status, $mesage): Response
    {
        $this->setHeader('HTTP/1.0 '.$status.' ' . $mesage);

        $this->body = json_encode([
            'status' => $status,
            'message' => $mesage,
        ]);
        return $this;
    }

    /**
     * @param $header
     * @return Response
     */
    public function setHeader($header): Response
    {
        $this->headers[] = $header;

        return $this;
    }

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