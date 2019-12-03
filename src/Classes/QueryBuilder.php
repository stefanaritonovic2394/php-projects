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
        private $array = [];
        private $namedKeysArr = [];
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
//            $this->query = " WHERE " .$this->implodeArrayKeys($condition);

            $arrayKeys = array_keys($condition);
            $arrayValues = $this->where = array_values($condition);

            $arrLength = count($condition);

            $this->query = " WHERE ";

//            $this->deleteElement($arrayValues, $condition);

            if ($this->is_assoc($condition) && $arrLength) {

                $i = 0;

                foreach ($condition as $key => $value) {
//                    $keyName = ":" . $key;
                    $this->array[$key] = $value;
//
//                    $this->namedKeysArr[] = array_keys($this->array);

                    $this->query .= $key . " = :" . $key;
                    if ($i != count($condition) - 1) {
                        $this->query .= " AND ";
                    }
                    $i++;
//                    var_dump($this->query);

                }
            } else {
                $this->query .= $this->implodeArrayKeys($condition);
                if (in_array(['=', '>', '<', '>=', '<='], $condition) && $arrLength === 3) {
                    $this->query .= $arrayValues[0] . $arrayValues[1] . $arrayValues[2];
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
                $this->data = $this->prepareExecuteAndFetch("SELECT * FROM " . self::$table . " " . $this->query, $this->array);
                return $this;
            }
        }

//        public function __toString()
//        {
//            return $this->get();
//        }

        public function selectById($id)
        {
            $this->data = $this->prepareExecuteAndFetch("SELECT * FROM " . self::$table . " " . $this->query, $this->array);
            return $this;
        }

        public function insertUser($name, $email, $password)
        {
//            $this->deleteElement($this->namedKeysArr, $this->array);
//            $this->implodeNamedArrayKeys($this->namedKeysArr);
//            for($x = 0; $x < count($this->namedKeysArr); $x++) {
//                $this->removeElement($this->namedKeysArr, $this->namedKeysArr[$x]);
////                unset($this->namedKeysArr[$x]);
//            }
//            $this->data = $this->prepareExecute("INSERT INTO " . self::$table . " (name, email, password) VALUES (" . $this->implodeNamedArrayKeys($this->namedKeysArr). ")", $this->array);
////            $stmt = $this->db->prepare("INSERT INTO users(name, email, password) VALUES(?, ?, ?)");
////            $stmt->execute(['name' => $name, 'email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT)]);
//            return true;
        }

        public function insert(array $params)
        {
            $implodeColumnArray = implode(", ", array_keys($params));
            $implodeValuesArray = implode(",:", array_keys($params));
            $this->data = $this->prepareExecute("INSERT INTO " . self::$table . "(" . $implodeColumnArray . ") VALUES (:" . $implodeValuesArray . ")", $params);
            return true;
        }

        public function update(array $params)
        {
            $this->query = "";
            $columnKeys = array_keys($params);
            $paramLength = count($params);

            for ($i = 0; $i < $paramLength; $i++) {
                $this->query .= $columnKeys[$i] . " = :" . $columnKeys[$i];
                if ($i != count($params) - 1) {
                    $this->query .= ", ";
                }
            }

            $this->query .= " WHERE ";
            $columnKeys = array_keys($this->array);

            for ($i = 0; $i < count($this->array); $i++) {
                $this->query .= $columnKeys[$i] . " = :" . $columnKeys[$i];
            }

            $params += $this->array;
//            die(var_dump($this->query));

            $this->data = $this->prepareExecute("UPDATE " . self::$table . " SET " . $this->query, $params);
//            var_dump($elements, $query); die();
//            $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
//            $stmt->execute(['name' => $name, 'email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT), 'id' => $id]);
            return true;
        }

        public function delete()
        {
            $this->query = "";
            $this->query .= " WHERE ";
            $columnKeys = array_keys($this->array);

            for ($i = 0; $i < count($this->array); $i++) {
                $this->query .= $columnKeys[$i] . " = :" . $columnKeys[$i];
            }

//            var_dump($this->query); die();

            $this->data = $this->prepareExecute("DELETE FROM " . self::$table . $this->query);
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

        public function implodeNamedArrayKeys($array) {
            return implode(", ", $array);
        }

        public function is_assoc($arr)
        {
            return array_keys($arr) !== range(0, count($arr) - 1);
        }

        public function deleteElement($element, &$array){
            $index = array_search($element, $array);
            if($index !== false){
                unset($array[$index]);
            }
        }

        public function removeElement($array, $value) {
            foreach (array_keys($array, $value) as $key) {
                unset($array[$key]);
            }
            return $array;
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
            foreach ($this->array as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
//            $stmt->bindParam($this->array, $params);
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