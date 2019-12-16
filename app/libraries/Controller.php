<?php

    namespace App\Libraries;
    use App\Models;

    class Controller
    {
        protected $model;
        protected $view;

        public function model($model)
        {
            $this->model = new $model;
            return $this->model;
        }

        public function view($view, $data = [])
        {
            if (file_exists(VIEW . $view . '.php')) {
                require_once VIEW . $view . '.php';
            } else {
                die('View does not exist');
            }
        }
    }