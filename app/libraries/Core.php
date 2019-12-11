<?php

    namespace App\Libraries;
    use App\Controllers\PagesController;

    class Core
    {
        protected $currentController = "PagesController";
        protected $currentMethod = "index";
        protected $params = [];

        public function __construct()
        {
//            print_r($this->getUrl());
            $url = $this->getUrl();

            if (class_exists('App\Controllers\\' . ucwords($url[0]))) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }

//            require_once '../app/Controllers/' . $this->currentController . '.php';
            $controller = "App\Controllers\\" . $this->currentController;

            $this->currentController = new $controller;

            if (isset($url[1])) {
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            $this->params = $url ? array_values($url) : [];

            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl()
        {
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }