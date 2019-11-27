<?php

    namespace App\Classes;
    use PDO;
    //include '../includes/config.php';
    //include __DIR__ . '/../includes/autoload.php';
    //require_once '../../vendor/autoload.php';

    // $dbInstance = Connection::getInstance();
    // $dbConnection = $dbInstance->getConnection();

    class QueryBuilder
    {
        private $db;
        private static $instance = null;
        private $stmt;
        private static $table;
//        private $connection;
//        private $params;
//        private $cols, $columns;
//        private $holders, $placehold;
//        private $fields, $field;
        private $executePrepare;
        private $where = [];
        private $and = [];
        private $data;
        private $query;

//        public $data;
//        public $results;

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

        public function where(array $condition = [])
        {
            $this->query = " WHERE ";

            $kljucevi = array_keys($condition);

            foreach ($condition as $key => $value) {
                $arrayValues = $this->where = $value;
                $arrayKeys = $this->where = $key;

                if ($this->is_assoc($condition)) {
                    if (count($condition) >= 2) {
                        for ($i = 0 ; $i < count($condition); $i++) {
                            $this->query .= $kljucevi[$i] . " = " . $condition[$kljucevi[$i]];
                            if($i != count($condition) - 1) {
                                $this->query .= " AND ";
                            }
                        }
//                        $andOperator = " AND ";
//                        $arrayAssocValues = $arrayKeys . " = " . $arrayValues . $andOperator;
//                        $trimmArr = rtrim($arrayAssocValues, $andOperator);
//                        print_r($trimmArr);
//                        $arrayAndValues = $this->and = " AND ". $key . " = ". $value;
//                        $this->query .= $trimmArr;
//                        var_dump($this->query); die();
                    } else {
                        $arrayAssocValues = $arrayKeys . " = " . $arrayValues;
                        $this->query .= $arrayAssocValues;
                    }
                } elseif (in_array(['=', '>', '<', '>=', '<='], $condition)) {
                    $this->query .= $arrayValues;
                }
            }
            return $this;
        }

        public function get()
        {
//            $array = (array)$this;
//            $string = implode(" ", $array);
//            return $string;
            return $this->data;
        }

        public function selectAll()
        {
//            $stmt = $this->db->prepare("SELECT * FROM " . self::$table);
//            $stmt->execute();
//            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//            return $result;
            if ($this->data) {
                $this->data = $this->prepareExecuteAndFetch("SELECT * FROM " . self::$table);
                return $this;
            } else {
                $this->data = $this->prepareExecuteAndFetch("SELECT * FROM " . self::$table . " " . $this->query);
                return $this;
            }
        }

//        public function __toString()
//        {
//            return $this->get();
//        }

        public function selectById($id)
        {
            $this->data = $this->prepareExecuteAndFetch("SELECT * FROM " . self::$table . " " . $this->query, ['id' => $id]);
            return $this;
        }

        public function insertUser($name, $email, $password)
        {
            $stmt = $this->db->prepare("INSERT INTO users(name, email, password) VALUES(?, ?, ?)");
            $stmt->execute(['name' => $name, 'email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT)]);
            return true;
        }

        public function updateUser($name, $email, $password, $id)
        {
            $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
            $stmt->execute(['name' => $name, 'email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT), 'id' => $id]);
            return true;
        }

        public function deleteUser($id)
        {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute(['id' => $id]);
            return true;
        }

        public function insertPost($title, $content, $created_at)
        {
            $stmt = $this->db->prepare("INSERT INTO posts(title, content, created_at) VALUES(?, ?, ?)");
            $stmt->execute(['title' => $title, 'content' => $content, 'created_at' => $created_at]);
            return true;
        }

        public function implodeArrayKeys($array) {
            return implode(" ", $array);
        }

        public function is_assoc($arr)
        {
            return array_keys($arr) !== range(0, count($arr) - 1);
        }

        public function convertArrayToString($array, $separator = '')
        {
            $str = '';
            foreach ($array as $arr)
            {
                $str .= implode($separator, $arr);
            }
            return $str;
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

        public function prepareExecuteAndFetch(string $query, array $params = [], $style = PDO::FETCH_ASSOC)
        {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            $this->executePrepare = $stmt->fetchAll($style);
            return $this->executePrepare;
        }

        public function prepareExecute(string $query, array $params = [])
        {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
        }

//        public function execute()
//        {
//            return $this->stmt->execute();
//        }

//        public function fetchAll($style = PDO::FETCH_ASSOC)
//        {
//            return $this->executePrepare->fetchAll($style);
//        }

    }