<?php

    namespace App\Libraries;

    class Router
    {
        protected $routes = [];
        protected $params = [];

        public function add($route, $params = [])
        {
//            $route = preg_replace('/\//', '\\/', $route);
//
//            $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
//
//            $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

//            $route = '/^' . $route . '$/i';

            $this->routes[$route] = $params;
        }

        public function getRoutes()
        {
            return $this->routes;
        }

        public function match($url)
        {
            $replace_url = str_replace('/php-projects/', '', $url);
            $this->params = explode('/', $replace_url);

            return true;

//            var_dump($this->routes);
//            var_dump($replace_url);

//            foreach ($this->routes as $route => $params) {
//
//                if ($route == $replace_url) {
//                    foreach($this->routes as $key_route){
//                        if(array_key_exists(0, $key_route)){
//                            $params[] = $key_route[0];
//                        }
//                    }
//                    return true;
//                }

//                if (preg_match($route, $replace_url, $matches)) {
//                    // Get named capture group values
//                    foreach ($matches as $key => $match) {
//                        if (is_string($key)) {
//                            $params[$key] = $match;
//                        }
//                    }
//                    $this->params = $params;
//                    return true;
//                }
//            }
//            return false;
        }

        public function getParams()
        {
            return $this->params;
        }

        public function dispatch($url)
        {
            $url = $this->removeQueryStringVariables($url);

            if ($this->match($url)) {
                $controller = $this->params[0] . 'Controller';
                $controller = $this->convertToStudlyCaps($controller);
                $controller = $this->getNamespace() . $controller;

                if (class_exists($controller)) {
                    $controller_object = new $controller($this->params);
                    $action = $this->params[1];
                    $action = $this->convertToCamelCase($action);

                    if ($action) {
                        $controller_object->$action();
                    } else {
                        throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
                    }

//                    if (preg_match('/action$/i', $action) == 0) {
//                        $controller_object->$action();
//                    } else {
//                        throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
//                    }
                } else {
                    throw new \Exception("Controller class $controller not found");
                }
            } else {
                throw new \Exception('No route matched.', 404);
            }

//            var_dump($controller);
        }

        protected function convertToStudlyCaps($string)
        {
            return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
        }

        protected function convertToCamelCase($string)
        {
            return lcfirst($this->convertToStudlyCaps($string));
        }

        protected function removeQueryStringVariables($url)
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

        protected function getNamespace()
        {
            $namespace = 'App\Controllers\\';
            if (array_key_exists('namespace', $this->params)) {
                $namespace .= $this->params['namespace'] . '\\';
            }
            return $namespace;
        }

//        public static function parse_url()
//        {
//            $dirname = dirname($_SERVER['SCRIPT_NAME']);
//            $basename = basename($_SERVER['SCRIPT_NAME']);
//            $request_uri = str_replace([$dirname, $basename], null, $_SERVER['REQUEST_URI']);
//            return $request_uri;
//        }
//
//        public static function run($url, $callback, $method = 'get')
//        {
//            $request_uri = self::parse_url();;
//
//            if (preg_match('@^' . $url . '$@', $request_uri, $parameters)) {
//                if (is_callable($callback)) {
//                    call_user_func_array($callback, $parameters);
//                }
//
//                $controller = explode('@', $callback);
//                print_r($controller);
//            }
//        }

    }