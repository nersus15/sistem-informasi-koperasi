<?php
class apps
{
    protected $controller = "auth";
    protected $method = "index";
    protected $parameter = [];
    public function __construct()
    {
        $url = $this->parseURL();
        //cek apakah ada file kontroller dengan nama sesuai di url
        if (file_exists('apps/controller/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        require_once 'apps/controller/' . $this->controller . '.php';
        $this->controller = new $this->controller;


        //cek apakah ada file method dengan nama sesuai di url
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        //cek apakah ada parameter yang dikirimkan
        if (!empty($url)) {
            $this->parameter = array_values($url);
        }

        //menjalankan controller, method, daan paramter
        call_user_func([$this->controller, $this->method], $this->parameter);
    }
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
