<?php

    namespace App\Libraries;

    class Request implements RequestInterface
    {
        private $requestMethod;
        private $requestUri;

        public function __construct()
        {
            $this->bootstrapSelf();
        }

        private function bootstrapSelf()
        {
            foreach($_SERVER as $key => $value)
            {
                $this->{$this->toCamelCase($key)} = $value;
            }
        }

        private function toCamelCase($string)
        {
            $result = strtolower($string);

            preg_match_all('/_[a-z]/', $result, $matches);

            foreach($matches[0] as $match)
            {
                $c = str_replace('_', '', strtoupper($match));
                $result = str_replace($match, $c, $result);
            }

            return $result;
        }

        public function getRequestBody()
        {
            if($this->requestMethod === "GET")
            {
                return "GET";
            }
            if ($this->requestMethod == "POST")
            {
                $body = [];
                foreach($_POST as $key => $value)
                {
                    $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                return $body;
            }
        }

        public function getRequestUri()
        {
            return $this->requestUri;
        }

        public function getRequestMethod()
        {
            return $this->requestMethod;
        }

    }
