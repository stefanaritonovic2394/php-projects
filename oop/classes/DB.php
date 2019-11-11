<?php

    class DB 
    {
        private static $instance = null;
        private static $conn;

        private $db_host = 'localhost';
        private $db_user = 'stefan';
        private $db_password = 'stefan12';
        private $db_name = 'oop_login_register';

        public function __construct() 
        {
            try {
                self::$conn = new PDO("mysql:host={$this->db_host};dbname={$this->db_name}", $this->db_user, $this->db_password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->exec('set names utf8');
                //echo $this->db_host . " connected successfully" . PHP_EOL;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                die;
            }
        }

        public static function getInstance()
        {
            if (!self::$instance) {
                self::$instance = new DB();
            }
            
            return self::$instance;
        }

        public static function getConnection() 
        {
            return self::$conn;
        }
    }
