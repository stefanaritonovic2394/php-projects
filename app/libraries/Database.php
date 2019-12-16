<?php

    namespace App\Libraries;
    use PDO;
    use PDOException;

    class Database
    {
        private static $instance = null;
        private static $pdo;

        private $db_host = DB_HOST;
        private $db_user = DB_USER;
        private $db_password = DB_PASS;
        private $db_name = DB_NAME;

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
                self::$instance = new self();
            }

            return self::getPDO();
        }

        public static function getPDO()
        {
            return self::$pdo;
        }
    }