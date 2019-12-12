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
        }

        public function loadControllersAndMethodsFromUrl()
        {
            $url = $this->getUrl();

            for ($i = 0; $i < count((array)$url); $i++) {
                if (class_exists('App\Controllers\\' . ucwords($url[$i]))) {
                    $this->currentController = ucwords($url[$i]);
                    unset($url[$i]);
                }
            }

//            require_once '../app/Controllers/' . $this->currentController . '.php';
            $controller = "App\Controllers\\" . $this->currentController;

            $this->currentController = new $controller;

//            $urlValues = array_values($url);
//            $lastElement = array_slice($url, 2, 1);

            for ($i = 0; $i < count((array)$url); $i++) {
                $lastUrlElement = end($url);

                if (isset($url[$i]) && $lastUrlElement) {
                    if (method_exists($this->currentController, $url[$i])) {
                        $this->currentMethod = $url[$i];
                        unset($url[$i]);
                    }
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