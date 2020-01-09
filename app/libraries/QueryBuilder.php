<?php

    namespace App\Libraries;

    use PDO;

    class QueryBuilder
    {
        private $db;
        private static $instance = null;
        private static $table;
        private $executePrepare;
        private $where = [];
        private $array = [];
        private $data = [];
        private $query;

        private function __construct()
        {
            $this->db = Database::getInstance();
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
            self::$table = $table;
            return self::getInstance();
        }

        public function where(array $condition = [])
        {
            $arrayKeys = array_keys($condition);
            $arrayValues = $this->where = array_values($condition);

            $arrLength = count($condition);

            $this->query = " WHERE ";

            if ($this->is_assoc($condition) && $arrLength) {

                $i = 0;

                foreach ($condition as $key => $value) {
                    $this->array[$key] = $value;

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

        public function join($joinTable, $condition, $type = 'INNER')
        {
            $allowedTypes = ['LEFT', 'RIGHT', 'INNER'];
            $joinType = strtoupper(trim($type));
            $joinTable = filter_var($joinTable, FILTER_SANITIZE_STRING);

            if ($joinType && !in_array($type, $allowedTypes)) {
                die("Wrong type of join " . $type);
            }

            $this->query .= " " . $type . " JOIN " . $joinTable . " ON ";
            $this->query .= $condition;
            return $this;
        }

        public function get()
        {
            return $this->prepareExecuteAndFetch($this->query);
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

        public function select(array $columns)
        {
            $column_values = array_values($columns);
            foreach ($column_values as $key => $value) {
                $this->query = "SELECT " . implode(', ', $columns) . " FROM " . self::$table;
            }
            return $this;
        }

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

        public function implodeArrayKeys($array) {
            return implode(" ", $array);
        }

        public function is_assoc($arr)
        {
            return array_keys($arr) !== range(0, count($arr) - 1);
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
            $stmt->execute($params);
        }

    }