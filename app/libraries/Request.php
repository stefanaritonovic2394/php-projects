<?php

    namespace App\Libraries;

    class Request implements RequestInterface
    {
        private static $requestMethod;
        private $requestUri;

        public function __construct()
        {
            $this->bootstrapSelf();
        }

        private function bootstrapSelf()
        {
            foreach($_SERVER as $key => $value)
            {
                self::$requestMethod = $_SERVER['REQUEST_METHOD'];
                $this->requestUri = $_SERVER['REQUEST_URI'];
            }
        }

        public function getRequestBody()
        {
            $body = [];

            if (self::$requestMethod === "GET") {
                return "GET";
            }

            if (self::$requestMethod === "POST") {

                foreach($_POST as $key => $value)
                {
                    $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }

                if (array_key_exists('_method', $_POST)) {
                    self::$requestMethod = 'PUT';
                    unset($_POST['_method']);
                }
            }

            if (self::$requestMethod === "PUT") {
                parse_str(file_get_contents("php://input"), $_PUT);

                foreach ($_PUT as $key => $value)
                {
                    unset($_PUT[$key]);
                    $_PUT[str_replace('amp;', '', $key)] = $value;
                }

                $_REQUEST = array_merge($_REQUEST, $_PUT);
            }

            return $body;
        }

        public static function get($key, $default = "")
        {
            if (!empty($_GET[$key])) {
                return $_GET[$key];
            }

            return $default;
        }

        public static function post($key, $default = "")
        {
            if (!empty($_POST[$key])) {
                return $_POST[$key];
            }

            return $default;
        }

        public function getRequestUri()
        {
            return $this->requestUri;
        }

        public static function getRequestMethod()
        {
            return self::$requestMethod;
        }

    }
