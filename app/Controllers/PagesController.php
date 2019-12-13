<?php

    namespace App\Controllers;
    use App\Libraries\Controller;

    class PagesController extends Controller
    {
        private $userModel;

        public function __construct()
        {
            $this->userModel = $this->model('User');
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