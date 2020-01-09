<?php

    namespace App\Libraries;

    class Core
    {
        protected $currentController = "PagesController";
        protected $currentMethod = "index";
        protected $params = [];

        public function __construct()
        {
        }

        public function loadControllersAndMethodsFromUrl()
        {
            $url = $this->getUrl();

            for ($i = 0; $i < count((array)$url); $i++) {
                if (class_exists('App\Controllers\\' . ucwords($url[$i]). 'Controller')) {
                    $this->currentController = ucwords($url[$i] . 'Controller');
                    unset($url[$i]);
                }
            }

            require_once CONTROLLER . $this->currentController . '.php';
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