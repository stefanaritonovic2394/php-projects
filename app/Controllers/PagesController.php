<?php

    namespace App\Controllers;
    use App\Libraries\Controller;
    use App\Libraries\QueryBuilder;
    use App\Models\Post;
    use App\Models\User as User;

    class PagesController extends Controller
    {
        private $queryBuilder;

        public function __construct()
        {
            $this->queryBuilder = QueryBuilder::getInstance();
        }

        public function index($name = '')
        {
            $user = $this->model(User::class);
            $user->name = $name;
            $users = $this->queryBuilder::table('users')->selectAll()->get();
            $posts = $this->queryBuilder::table('posts')->selectAll()->get();
//            $users = $user->getUsers();
//            $posts = $post->getPosts();

            $data = [
                'title' => 'Welcome',
                'name' => $user->name,
                'users' => $users,
                'posts' => $posts
            ];

            $this->view('pages/index', $data);
        }

        public function about()
        {
            $data = [
                'title' => 'About',
            ];

            $this->view('pages/about', $data);
        }

        public function show($id = '')
        {
            $user = $this->model(User::class);
            $findpost = $this->queryBuilder::table('posts')->selectById($id);

            $data = [
                'post' => $findpost
            ];

            $this->view('pages/show', $data);
        }

        public function store()
        {
            $insertPost = $this->queryBuilder::table('posts')->insert([
                'title' => 'Treci post',
                'content' => 'Ovo je treci post',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        public function update()
        {
            $updatePost = $this->queryBuilder::table('posts')->where(['id' => 3])->update([
                'title' => 'Treci Post',
                'content' => 'Sadrzaj treceg posta',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        public function delete()
        {
            $deletePost = QueryBuilder::table('posts')->where(['id' => 3])->delete();

            $this->view('pages/index');
        }

    }