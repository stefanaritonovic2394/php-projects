<?php

    namespace App\Models;

    use App\Libraries\Database;
    use App\Libraries\QueryBuilder;

    class User
    {
        private $db;
        private $queryBuilder;
        public $name;
        public $email;
        public $password;

        public function __construct()
        {
//            $this->db = Database::getInstance();
//            $this->queryBuilder = QueryBuilder::table('users')->selectAll()->get();
        }

        public function getUsers() {
            return $this->queryBuilder = QueryBuilder::table('users')->selectAll()->get();
        }

    }