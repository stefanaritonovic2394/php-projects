<?php

    namespace App\Controllers;
    use App\Libraries\Controller;

    class Users extends Controller
    {
        protected $currentController = "Users";

        public function __construct()
        {
            echo "Users loaded!";
        }
    }