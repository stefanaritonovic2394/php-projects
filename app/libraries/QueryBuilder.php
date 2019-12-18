<?php

    namespace App\Libraries;

    use PDO;
    use App\Models\User;

    class QueryBuilder
    {
        private $db;
        private static $instance = null;
        private $stmt;
        private static $table;
        private $executePrepare;
        private $where = [];
        private $and = [];
        private $array = [];
        private $namedKeysArr = [];
        private $data;
        private $query;
        private $validator;

//        public $data;
//        public $results;

        private function __construct()
        {
            $this->db = Database::getInstance();
//            $this->validator = new Validator();
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
            if ($this->data) {
                $this->data = $this->prepareExecuteAndFetch("SELECT * FROM " . self::$table, [], PDO::FETCH_CLASS, 'App\Models\\' . rtrim(ucfirst(self::$table), 's'));
                return $this;
            } else {
                $this->data = $this->prepareExecuteAndFetch("SELECT * FROM " . self::$table . " " . $this->query, $this->array, PDO::FETCH_CLASS, 'App\Models\\' . rtrim(ucfirst(self::$table), 's'));
                return $this;
            }
        }

//        public function __toString()
//        {
//            return $this->get();
//        }

        public function selectById($id)
        {
            $this->where(['id' => $id]);
            $this->data = $this->prepareExecuteAndFetch("SELECT * FROM " . self::$table . " " . $this->query, $this->array, PDO::FETCH_CLASS, 'App\Models\\' . rtrim(ucfirst(self::$table), 's'));
            return $this->data;
        }

        public function insert(array $params)
        {
            $implodeColumnArray = implode(", ", array_keys($params));
            $implodeValuesArray = implode(",:", array_keys($params));
//            $validator = new Validator();
//            $validator->validate($params)->operator();
//
////            $this->validate($params['name'])->int()->max(50)->min(3);
//            if (!$validator->getErrors()) {
//                $this->data = $this->prepareExecute("INSERT INTO " . self::$table . "(" . $implodeColumnArray . ") VALUES (:" . $implodeValuesArray . ")", $params);
//            } else {
//                foreach ($validator->getErrors() as $error)
//                {
//                    echo "$error";
//                }
//            }
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

//            $this->validator->validate($params)->operator();

            $params += $this->array;

//            $this->validate($params['name'])->int()->max(50)->min(3);
//            if (!$this->validator->getErrors()) {
//                $this->data = $this->prepareExecute("UPDATE " . self::$table . " SET " . $this->query, $params);
////                $this->data = $this->prepareExecute("INSERT INTO " . self::$table . "(" . $implodeColumnArray . ") VALUES (:" . $implodeValuesArray . ")", $params);
//            } else {
//                foreach ($this->validator->getErrors() as $error)
//                {
//                    echo "$error";
//                }
//            }
            $this->data = $this->prepareExecute("UPDATE " . self::$table . " SET " . $this->query, $params);
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

            $this->data = $this->prepareExecute("DELETE FROM " . self::$table . $this->query, $this->array);
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

        public function prepareExecuteAndFetch(string $query, array $params = [], $style = PDO::FETCH_ASSOC, $class = null)
        {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);

            switch ($style) {
                case PDO::FETCH_ASSOC:
                    return $this->executePrepare = $stmt->fetchAll($style);
                    break;
                case PDO::FETCH_CLASS:
                    return $this->executePrepare = $stmt->fetchAll($style, $class);
                    break;
            }

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

    }