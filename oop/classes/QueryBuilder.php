<?php

    require_once 'classes/Connection.php';

    // $dbInstance = Connection::getInstance();
    // $dbConnection = $dbInstance->getConnection();

    class QueryBuilder 
    {
        private $db;
        private static $instance = null;
        private $stmt;
        private static $table;
        private $connection;
        private $param;
        private $cols, $columns;
        private $holders, $placehold;
        private $fields, $field;

        public $data;
        public $results;

        private function __construct()
        {
            $this->db = Connection::getInstance();
            //$this->connection = Connection::getPDO();
        }

        public static function getInstance()
        {
            if (!self::$instance) {
                self::$instance = new QueryBuilder();
            }

            return self::$instance;
        }

        public static function table($table)
        {
//            $this->table = $table;
            self::$table = $table;
            return self::getInstance();
        }

        public function selectAll()
        {
            $stmt = $this->db->prepare("SELECT * FROM " . self::$table);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function selectById($id)
        {
            $stmt = $this->db->prepare("SELECT * FROM " . self::$table . " WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function insertUser($name, $email, $password)
        {
            $stmt = $this->db->prepare("INSERT INTO users(name, email, password) VALUES(:name, :email, :password)");
            $stmt->execute(['name' => $name, 'email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT)]);
            return true;
        }

        public function updateUser($name, $email, $password, $id)
        {
            $stmt = $this->db->prepare("UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id");
            $stmt->execute(['name' => $name, 'email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT), 'id' => $id]);
            return true;
        }

        public function deleteUser($id)
        {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return true;
        }

        public function insertPost($title, $content, $created_at)
        {
            $stmt = $this->db->prepare("INSERT INTO posts(title, content, created_at) VALUES(:title, :content, :created_at)");
            $stmt->execute(['title' => $title, 'content' => $content, 'created_at' => $created_at]);
            return true;
        }

        // private function setColumns(array $columns)
        // {
        //     $cols = implode(', ', array_values($columns));
        //     return $cols;
        // }

        // public function select($table, array $columns, $field, $param)
        // {
        //     $cols = $this->setColumns($columns);
        //     $stmt = $this->db->prepare("SELECT $cols FROM $table WHERE $field = ?");
        //     $stmt->execute(array($param));
        //     $result = $stmt->fetch();
        //     return json_encode($result);
        // }

        public function query($query)
        {
            $this->stmt = $this->conn->prepare($query);
        }

        public function execute()
        {
            return $this->stmt->execute();
        }

    }