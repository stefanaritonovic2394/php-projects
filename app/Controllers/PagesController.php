<?php

    namespace App\Controllers;
    use App\Libraries\Controller;
    use App\Models\Post;
    use App\Models\User as User;

    class PagesController extends Controller
    {
        public function __construct()
        {
        }

        public function index($name = '')
        {
            $user = $this->model(User::class);
            $user->name = $name;
            $user = new User();
            $post = new Post();
            $users = $user->getUsers();
            $posts = $post->getPosts();

            $data = [
                'title' => 'Welcome',
                'name' => $user->name,
                'users' => $users,
                'posts' => $posts
            ];

            $this->view('pages/index', $data);
        }

        public function about($id = '')
        {
            $data = [
                'title' => 'About',
                'id' => $id
            ];

            $this->view('pages/about', $data);
        }
    }