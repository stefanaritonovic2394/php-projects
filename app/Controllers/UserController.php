<?php

    namespace App\Controllers;

    use App\Libraries\Controller;
    use App\Libraries\QueryBuilder;
    use App\Libraries\Request;
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
            $users = $this->queryBuilder::table('users')->select(['users.id', 'name', 'email'])->join('posts', 'users.post_id = posts.id', 'LEFT')->get();
            $data = ['users' => $users];

            $this->view('user/index', $data);
        }

        public function create()
        {
            $this->view('user/create');
        }

        public function show($id = '')
        {
            $user = $this->model(User::class);
            $finduser = $this->queryBuilder::table('users')->selectById($id);
            $data = ['user' => $finduser];

            $this->view('user/show', $data);
        }

        public function store()
        {
            $name = Request::post('name');
            $email = Request::post('email');
            $password = Request::post('password');

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;

            $insert = $this->queryBuilder::table('users')->insert([
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ]);

            header('Location: ' . URL_ROOT . '/user/index');
        }

        public function edit($id = null)
        {
            $data['user'] = $this->queryBuilder::table('users')->selectById($id);
            $this->view('user/edit', $data);
        }

        public function update()
        {
            $id = Request::post('id');
            $name = Request::post('name');
            $email = Request::post('email');
            $password = Request::post('password');

            $update = $this->queryBuilder::table('users')->where(['id' => $id])->update([
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ]);

            header('Location: ' . URL_ROOT . '/user/index');
        }

        public function delete($id = null)
        {
            $delete = QueryBuilder::table('users')->where(['id' => $id])->delete();
            header('Location: ' . URL_ROOT . '/user/index');
        }

    }