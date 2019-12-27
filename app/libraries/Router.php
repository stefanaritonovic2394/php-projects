<?php

    namespace App\Libraries;

    class Router
    {
        protected $routes = [];
        protected $controller;
        protected $action;
        protected $request;
        protected $params = [];

        public function add($route, $params = [])
        {
            $this->routes[$route] = $params;
        }

        public function getRoutes()
        {
            return $this->routes;
        }

        public function getParams()
        {
            return $this->params;
        }

        public function match($url)
        {
            $url = str_replace('/php-projects/', '/', $url);
            $this->params = explode('/', $url);
            unset($this->params[0]);

            foreach ($this->routes as $route => $params) {
                if ($route == $url) {
                    return true;
                }
            }
        }

        public function dispatch($url)
        {
            $url = $this->removeQueryStringVariables($url);

            if ($this->match($url)) {
//                $this->params = explode("@", $url);
                $controller = $this->params[1] . 'Controller';
                $controller = $this->convertToStudlyCaps($controller);
                $controller = $this->getNamespace() . $controller;

                if (class_exists($controller)) {
                    $controller_object = new $controller($this->params);
                    $action = $this->params[2];
                    $action = $this->convertToCamelCase($action);

                    if ($action) {
                        $controller_object->$action();
                    }
                }
            }

        }

        public function convertToStudlyCaps($string)
        {
            return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
        }

        public function convertToCamelCase($string)
        {
            return lcfirst($this->convertToStudlyCaps($string));
        }

        public function removeQueryStringVariables($url)
        {
            if ($url != '') {
                $parts = explode('&', $url, 2);
                if (strpos($parts[0], '=') === false) {
                    $url = $parts[0];
                } else {
                    $url = '';
                }
            }
            return $url;
        }

        public function getNamespace()
        {
            $namespace = 'App\Controllers\\';
            if (array_key_exists('namespace', $this->params)) {
                $namespace .= $this->params['namespace'] . '\\';
            }
            return $namespace;
        }

    }