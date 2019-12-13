<?php

    namespace App\Models;

    use App\Libraries\Database;
    use App\Libraries\QueryBuilder;

    class User
    {
        private $queryBuilder;
        private $name;
        private $email;
        private $password;

        public function __construct()
        {
            $this->queryBuilder = QueryBuilder::getInstance();
        }

    }