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
        }

        public function int()
        {
            if (!is_int($this->object)) {
                $this->errors[] = "Must be integer";
            }
            return $this;
        }

        public function max($value)
        {
            if (!count($value) < 8) {
                $this->errors[] = "Must be greater than 8";
            }
            return $this;
        }

        public function min($value)
        {
            if (count($value) < 8) {
                $this->errors[] = "Must be greater than 8";
            }
            return $this;
        }

        public function getErrors() {
            return $this->errors;
        }
    }
