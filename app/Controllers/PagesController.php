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
            $this->view('pages/index', ['title' => 'Welcome']);
        }

        public function about()
        {
            $data = [
                'title' => 'About'
            ];

            $this->view('pages/about', $data);
        }
    }