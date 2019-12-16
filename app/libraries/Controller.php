<?php

    namespace App\Libraries;

    class Controller
    {
        public function model($model)
        {
            // ovo nije dobro resenje. Zasto nis koristio autoload i instancirao model?
            if (file_exists('../app/Models/' . $model . '.php')) {
                require_once '../app/Models/' . $model . '.php';
//                return new $model();
            } else {
                die('Model does not exist');
            }

        }

        public function view($view, $data = [])
        {
            if (file_exists('../app/Views/' . $view . '.php')) {
                require_once '../app/Views/' . $view . '.php';
            } else {
                die('View does not exist');
            }
        }
    }