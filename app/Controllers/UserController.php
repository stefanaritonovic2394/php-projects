<?php

    namespace App\Controllers;

    use App\Libraries\Controller;
    use App\Libraries\QueryBuilder;
    use App\Models\User;

    class UserController extends Controller
    {
        private $queryBuilder;

        public function __construct()
        {
            $this->queryBuilder = QueryBuilder::getInstance();
        }

        public function index()
        {
            $users = $this->queryBuilder::table('users')->selectAll()->get();

            $data = ['users' => $users];

            $this->view('user/index', $data);
        }

        public function create()
        {
            $this->view('user/create');
        }

        public function store()
        {
            $user = new User();
            $user->name;

            $this->view('user/create');
//            $insert = $this->queryBuilder::table('users')->insert([]);
        }

        public function edit($id = '')
        {
            $user = $this->queryBuilder::table('users')->selectById($id);
            $this->view('user/edit');
        }

    }