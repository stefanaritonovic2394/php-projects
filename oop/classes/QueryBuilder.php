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
            $stmt = self::$db->prepare("SELECT * FROM users");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
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