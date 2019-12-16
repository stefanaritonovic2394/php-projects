<?php

    namespace App\Models;

    use App\Libraries\QueryBuilder;

    class Post
    {
        public $title;
        public $content;
        public $created_at;
        private $queryBuilder;

        public function getPosts() {
            return $this->queryBuilder = QueryBuilder::table('posts')->selectAll()->get();
        }

    }