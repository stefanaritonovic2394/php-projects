<?php

    namespace App\Libraries;

    interface RequestInterface
    {
        public function getRequestBody();
        public function getRequestUri();
        public function getRequestMethod();
    }