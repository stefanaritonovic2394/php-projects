<?php

    namespace App\Controllers;
    use App\Libraries\Controller;

    class PagesController extends Controller
    {
        public function __construct()
        {
//            echo "PagesController";
//            $this->index();
        }

        public function index()
        {
//            $this->view('index');
        }

        public function about($id)
        {
            echo $id;
        }
    }