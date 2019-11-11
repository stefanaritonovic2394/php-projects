<?php

    require_once 'classes/DB.php';

    // $dbInstance = DB::getInstance();
    // $dbConnection = $dbInstance->getConnection();

    class QueryBuilder 
    {
        private static $db;
        private $stmt;
        private $table;
        private $param;
        private $cols, $columns;
        private $holders, $placehold;
        private $fields, $field;

        public $data;
        public $results;

        public function __construct()
        {
            self::$db = DB::getInstance();
        }

        public static function selectAll()
        {
            $connection = DB::getConnection();
            $stmt = $connection->prepare("SELECT * FROM users");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public static function selectById($id)
        {
            $connection = DB::getConnection();
            $stmt = $connection->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public static function insertUser($name, $email, $password)
        {
            $connection = DB::getConnection();
            $stmt = $connection->prepare("INSERT INTO users(name, email, password) VALUES(:name, :email, :password)");
            $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
            return true;
        }

        public static function updateUser($name, $email, $password, $id)
        {
            $connection = DB::getConnection();
            $stmt = $connection->prepare("UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id");
            $stmt->execute(['name' => $name, 'email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT), 'id' => $id]);
            return true;
        }

        public static function deleteUser($id)
        {
            $connection = DB::getConnection();
            $stmt = $connection->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return true;
        }

        private function setColumns(array $columns)
        {
            $cols = implode(', ', array_values($columns));
            return $cols;
        }

        public function select($table, array $columns, $field, $param)
        {
            $cols = $this->setColumns($columns);
            $stmt = $this->db->prepare("SELECT $cols FROM $table WHERE $field = ?");
            $stmt->execute(array($param));
            $result = $stmt->fetch();
            return json_encode($result);
        }

        public function query($query)
        {
            $this->stmt = $this->conn->prepare($query);
        }

        public function execute()
        {
            return $this->stmt->execute();
        }

    }