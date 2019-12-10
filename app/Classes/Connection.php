<?php

    namespace App\Classes;
    use PDO;

    class Connection
    {
        private static $instance = null;
        private static $pdo;

        private $db_host = 'localhost';
        private $db_user = 'root';
        private $db_password = 'stefan95';
        private $db_name = 'oop_login_register';

        private function __construct() 
        {
            try {
                self::$pdo = new PDO("mysql:host={$this->db_host};dbname={$this->db_name}", $this->db_user, $this->db_password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->exec('set names utf8');
                //echo $this->db_host . " connected successfully" . PHP_EOL;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                die;
            }
        }

        public static function getInstance()
        {
            if (!self::$instance) {
                self::$instance = new Connection();
            }
            
            return self::getPDO();
        }

        public static function getPDO()
        {
            return self::$pdo;
        }
    }
