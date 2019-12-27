<?php

    namespace App\Controllers;

    use App\Libraries\Controller;
    use App\Libraries\QueryBuilder;
    use App\Libraries\Request;
    use App\Models\Post;

    class PostController extends Controller
    {
        private $queryBuilder;

        public function __construct()
        {
            $this->queryBuilder = QueryBuilder::getInstance();
        }

        public function index()
        {
            $posts = $this->queryBuilder::table('posts')->selectAll()->get();

            $data = ['posts' => $posts];

            $this->view('post/index', $data);
        }

        public function create()
        {
            $this->view('post/create');
        }

        public function show($id = '')
        {
            $post = $this->model(Post::class);
            $findpost = $this->queryBuilder::table('posts')->selectById($id);

            $data = [
                'post' => $findpost
            ];

            $this->view('post/show', $data);
        }

        public function store()
        {
            $title = Request::post('title');
            $content = Request::post('content');
            $created_at = Request::post('created_at');
//            $name = $_POST['name'];
//            $email = $_POST['email'];
//            $password = $_POST['password'];

            $post = new Post();
            $post->title = $title;
            $post->content = $content;
            $post->created_at = $created_at;

            $insert = $this->queryBuilder::table('posts')->insert([
                'title' => $title,
                'content' => $content,
                'created_at' => $created_at
            ]);

            header('Location: ' . URL_ROOT . '/post');

//                $this->view('user/index');
        }

        public function edit($id = '')
        {
            $data['post'] = $this->queryBuilder::table('posts')->selectById($id);
            $this->view('post/edit', $data);
        }

        public function update()
        {
            $id = Request::post('id');
            $title = Request::post('title');
            $content = Request::post('content');
            $created_at = Request::post('created_at');

            $update = $this->queryBuilder::table('posts')->where(['id' => $id])->update([
                'title' => $title,
                'content' => $content,
                'created_at' => $created_at
            ]);

            header('Location: ' . URL_ROOT . '/post');

        }

        public function delete($id)
        {
            $delete = QueryBuilder::table('posts')->where(['id' => $id])->delete();
            header('Location: ' . URL_ROOT . '/post');
        }

    }