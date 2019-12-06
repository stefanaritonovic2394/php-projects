<?php

    namespace App\Classes;

    class Validator implements ValidatorInterface
    {
        private $validators;
        private $object;
        private $errors = [];
//        protected $validate;
//
//        public function __construct($validate = null)
//        {
//            $this->validate = $validate;
//        }

        public function validate($data)
        {
            $this->object = $data;
            return $this;
        }

        public function int()
        {
            if (!is_int($this->object)) {
                $this->errors[] = "Must be integer";
            }
            return $this;
        }

        public function empty()
        {
            if (empty($this->object)) {
                $this->errors[] = "Must not be empty";
            }
            return $this;
        }

        public function max($value)
        {
            if (strlen($value) > 10) {
                $this->errors[] = "Must not be greater than 10 characters";
            }
            return $this;
        }

        public function min($value)
        {
            if (strlen($value) < 6) {
                $this->errors[] = "Must be at least 6 characters long";
            }
            return $this;
        }

        public function getErrors() {
            return $this->errors;
        }

    }
