<?php

    namespace App\Libraries;

    class Router
    {
        private $request;
        private $httpMethods = [
            "GET",
            "POST"
        ];

        public function __construct(RequestInterface $request)
        {
            $this->request = $request;
        }

        function __call($name, $args)
        {
            list($route, $method) = $args;

            if (!in_array(strtoupper($name), $this->httpMethods))
            {
                $this->invalidMethodHandler();
            }

            $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
        }

        private function formatRoute($route)
        {
            $result = rtrim($route, '/');

            if ($result === '')
            {
                return '/';
            }

            return $result;
        }

        private function invalidMethodHandler()
        {
//            header("{$this->request->serverProtocol} 405 Method Not Allowed");
        }

        private function defaultRequestHandler()
        {
            echo "404 Not Found";
//            header("{$this->request->serverProtocol} 404 Not Found");
        }

        public function resolve()
        {
            $methodDictionary = $this->{strtolower($this->request->getRequestMethod())};
            $formatedRoute = $this->formatRoute($this->request->getRequestUri());
            $method = $methodDictionary[$formatedRoute];

            if (is_null($method))
            {
                $this->defaultRequestHandler();
                return;
            }

            call_user_func_array($method, [$this->request]);
        }

        public function __destruct()
        {
            $this->resolve();
        }

    }