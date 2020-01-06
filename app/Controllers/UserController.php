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
            $users = $this->queryBuilder::table('users')->selectAll()->get();

            $data = ['users' => $users];
            $join = $this->queryBuilder->selectAll()->join('posts', 'users.post_id = posts.id', 'RIGHT')->get();

            $select = $this->queryBuilder::table('users')->select(['name', 'email'])->join('posts', 'users.post_id = posts.id', 'RIGHT')->get();
            $this->view('user/index', $data);
        }

        public function create()
        {
            $this->view('user/create');
        }

        public function show($id = '')
        {
            $user = $this->model(User::class);
            $finduser = $this->queryBuilder::table('posts')->selectById($id);

            $data = [
                'user' => $finduser
            ];

            $this->view('user/show', $data);
        }

        public function store()
        {
            $name = Request::post('name');
            $post_id = Request::post('post_id');
            $email = Request::post('email');
            $password = Request::post('password');
//            $name = $_POST['name'];
//            $email = $_POST['email'];
//            $password = $_POST['password'];

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;

            $insert = $this->queryBuilder::table('users')->insert([
                'name' => $name,
                'post_id' => $post_id,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ]);

            header('Location: ' . URL_ROOT . '/user/index');

//                $this->view('user/index');
        }

        public function edit($id = null)
        {
            $data['user'] = $this->queryBuilder::table('users')->selectById($id);
//            $viewPath = '/user/edit/';
//            $viewPath = ltrim($viewPath, '/');
//            $viewPath = rtrim($viewPath, '/');
//            var_dump($viewPath);
            $this->view('user/edit', $data);
        }

        public function update()
        {
            $id = Request::post('id');
            $name = Request::post('name');
            $email = Request::post('email');
            $password = Request::post('password');

//            $user = $this->queryBuilder::table('users')->selectById($id);

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

//            $this->view('user/index');
        }

    }